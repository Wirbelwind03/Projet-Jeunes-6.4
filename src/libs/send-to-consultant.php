<?php
    if(session_status() === 1){
        session_start();
    }

    // Créer un consultant dans le fichier JSON
    function createConsultant()
    {
        $usersJsonFile = file_get_contents(__DIR__ . "/../database/users.json");

        $newConsultant = array(
            "name" => strtoupper($_POST["consultantName"]),
            "firstname" => ucfirst($_POST["consultantFirstName"]),
            "birthDate" => "1999-01-01",
            "mail" => strtolower($_POST["consultantMail"]),
            "password" => "1",
        );

        // Converti le JSON en une liste php
        $decoded_json = json_decode($usersJsonFile, true);

        if (!array_key_exists($newConsultant["mail"], $decoded_json["consultants"]))
        {
            // Ajoute le nouveau mail dans l'objet "consultants"
            $decoded_json['consultants'][$newConsultant["mail"]] = $newConsultant;
            
            // Convertir la liste php en json
            $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);

            // Ecrire le nouveau utilisateur dans le fichier JSON
            file_put_contents(__DIR__ . "/../database/users.json", $encoded_json);

            // Créer le dossier pour l'utilisateur
            if (!is_dir(__DIR__ . "/../database/consultants/" . $newConsultant["mail"])) {
                mkdir(__DIR__ . "/../database/consultants/" . $newConsultant["mail"], 0777, true);
            }

            // Création de la base de données des références pour l'utilisateur
            $referralsData = array(
                "referralsAll" =>  (object)array(),
                "referralsReceived" => array()
            );
            
            // Converti la liste PHP en JSON
            $referralsJson = json_encode($referralsData, JSON_PRETTY_PRINT);
            
            // Ecrire le fichier JSON contenant les références
            file_put_contents(__DIR__ . "/../database/consultants/" . $newConsultant["mail"] . "/referrals.json", $referralsJson);
        }
    }

    // Envoie une référence validée à un consultant

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // On récupère les informations du formulaire
        $referralHash = $_POST["referralHash"];
        $consultantMail = $_POST["consultantMail"];

        createConsultant();

        // Ouvrir les références du Jeune pour le copier au consultant
        // Chemin pour le fichier contenant les références du Jeune
        $juniorReferralsPath = __DIR__ . "/../database/juniors/" . $_SESSION['user']['mail'] . "/referrals.json";
        if (file_exists($juniorReferralsPath)){
            
            // On ouvre le fichier JSON contenant les références du Jeune
            $jsonFile = file_get_contents($juniorReferralsPath);
            // On converti le JSON en une liste PHP
            $juniorDecodedJson = json_decode($jsonFile, true);

        }
        else{
            echo "failed";
            exit;
        }

        // Chemin pour le fichier contenant les références du Consultant
        $consultantReferralsPath = __DIR__ . "/../database/consultants/" . $consultantMail . "/referrals.json";
        if (file_exists($consultantReferralsPath)){
            
            // On ouvre le fichier JSON contenant les références du Consultant
            $jsonFile = file_get_contents($consultantReferralsPath);
            // On converti le JSON en une liste PHP
            $consultantDecodedJson = json_decode($jsonFile, true);
            
            // Récupérer la référence du Jeune pour le copier au consultant
            $consultantDecodedJson["referralsAll"][$referralHash] = $juniorDecodedJson["referralsAll"][$referralHash];
            // On ajoute la référence reçue à la liste "referralsReceived"
            $consultantDecodedJson["referralsReceived"][] = $referralHash;
            
            // On converti la liste PHP en JSON
            $encoded_json = json_encode($consultantDecodedJson, JSON_PRETTY_PRINT);
            // On sauvergade le JSON contenant les références du Consultant
            file_put_contents($consultantReferralsPath, $encoded_json);

            exit;

        }
        else{
            echo "failed";
            exit;
        }

        echo "failed";
    }
?>