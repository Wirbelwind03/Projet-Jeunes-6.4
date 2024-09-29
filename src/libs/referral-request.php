<?php
    if(session_status() === 1){
        session_start();
    }

    // Créer un référent dans le fichier JSON
    function createReferent($newReferral)
    {
        $usersJsonFile = file_get_contents(__DIR__ . "/../database/users.json");

        $newReferent = array(
            "name" => $newReferral["referentName"],
            "firstname" => $newReferral["referentFirstName"],
            "birthDate" => $newReferral["referentBirthDate"],
            "mail" => $newReferral["referentMail"],
            "password" => "1",
            "socialMedias" => $newReferral["referentSocialMedias"],
        );

        // Converti le JSON en une liste php
        $decoded_json = json_decode($usersJsonFile, true);

        if (!array_key_exists($newReferent["mail"], $decoded_json["referents"]))
        {
            // Ajoute le nouveau mail dans l'objet "referents"
            $decoded_json['referents'][$newReferent["mail"]] = $newReferent;
            
            // Convertir la liste php en json
            $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);

            // Ecrire le nouveau utilisateur dans le fichier JSON
            file_put_contents(__DIR__ . "/../database/users.json", $encoded_json);

            // Créer le dossier pour l'utilisateur
            if (!is_dir(__DIR__ . "/../database/referents/" . $newReferent["mail"])) {
                mkdir(__DIR__ . "/../database/referents/" . $newReferent["mail"], 0777, true);
            }

            // Création de la base de données des références pour l'utilisateur
            $referralsData = array(
                "referralsAll" =>  (object)array(),
                "referralsReceived" => array(),
                "referralsValidated" => array()
            );
            
            // Converti la liste PHP en JSON
            $referralsJson = json_encode($referralsData, JSON_PRETTY_PRINT);
            
            // Ecrire le fichier JSON contenant les références
            file_put_contents(__DIR__ . "/../database/referents/" . $newReferent["mail"] . "/referrals.json", $referralsJson);
        }
    }

    // Envoie une demande de référence à une référent

    // Récupère l'horaire de France
    date_default_timezone_set('Europe/Paris');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // Récupère les informations du formulaire
        $newReferral = array(
            "referentName" => strtoupper($_POST['referentName']),
            "referentFirstName" => ucfirst($_POST['referentFirstName']),
            "referentMail" => strtolower($_POST['referentMail']),
            "referentBirthDate" => $_POST['referentBirthDate'],
            "referentSocialMedias" => $_POST['referentSocialMedias'],
            "commentary" => "",
            "expertises" => [],
            
            "juniorName" => $_SESSION['user']['name'],
            "juniorFirstName" => $_SESSION['user']['firstname'],
            "juniorMail" => $_SESSION['user']['mail'],

            "date" => date('d-m-y h:i:s'),

            "commitment" => $_POST['commitment'],
            "duration" => $_POST['duration'],
            "environment"=> $_POST['environment'],
            "skills"=> $_POST['skills'],

            "validated"=> false,
            "read" => false
        );

        createReferent($newReferral);

        // Génère un hashage pour la référence
        $referralHash = bin2hex(random_bytes(18));

        $referentReferralsPath = __DIR__ . "/../database/referents/" . $newReferral["referentMail"] . "/referrals.json";
        if (file_exists($referentReferralsPath)){
                        
            $jsonFile = file_get_contents($referentReferralsPath);
            $decoded_json = json_decode($jsonFile, true);
            
            $decoded_json["referralsAll"][$referralHash] = $newReferral;
            $decoded_json["referralsReceived"][] = $referralHash;
            
            $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);
            file_put_contents($referentReferralsPath, $encoded_json);
        }
        else{
            echo "failed";
            exit;
        }

        $juniorReferralsPath = __DIR__ . "/../database/juniors/" . $_SESSION['user']['mail'] . "/referrals.json";
        if (file_exists($juniorReferralsPath)){
            $newReferral["read"] = true;
            
            $jsonFile = file_get_contents($juniorReferralsPath);
            $decoded_json = json_decode($jsonFile, true);
            
            $decoded_json["referralsAll"][$referralHash] = $newReferral;
            $decoded_json["referralsSended"][] = $referralHash;
            
            $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);
            file_put_contents($juniorReferralsPath, $encoded_json);

            exit;
        }
        else{
            echo "failed";
            exit;
        }
    }
?>