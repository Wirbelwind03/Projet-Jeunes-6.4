<?php
    if(session_status() === 1){
        session_start();
    }

    // Fait la validation d'une référence d'un Jeune par un Référent

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $referralHash = $_POST["referralHash"];
    
        // Chemin pour le fichier contenant les références du Référent
        $referentReferralsPath = __DIR__ . "/../database/referents/" . $_SESSION["user"]["mail"] . "/referrals.json";
        if (file_exists($referentReferralsPath)){
            
            // On ouvre le fichier JSON contenant les références du Référent
            $jsonFile = file_get_contents($referentReferralsPath);
            // On converti le JSON en une liste PHP
            $referentDecodedJson = json_decode($jsonFile, true);
            
            // On met à jour la référence pour le Référent
            $referentDecodedJson['referralsAll'][$referralHash]["validated"] = true;
            if (isset($_POST['referentName'])){
                $referentDecodedJson['referralsAll'][$referralHash]["referentName"] = $_POST['referentName'];
            }
            if (isset($_POST['referentFirstName'])){
                $referentDecodedJson['referralsAll'][$referralHash]["referentFirstName"] = $_POST['referentFirstName'];
            }
            if (isset($_POST['referentBirthDate'])){
                $referentDecodedJson['referralsAll'][$referralHash]["referentBirthDate"] = $_POST['referentBirthDate'];
            }
            if (isset($_POST['referentSocialMedias'])){
                $referentDecodedJson['referralsAll'][$referralHash]["referentSocialMedias"] = $_POST['referentSocialMedias'];
            }
            $referentDecodedJson['referralsAll'][$referralHash]["commentary"] = $_POST['commentary'];
            $referentDecodedJson['referralsAll'][$referralHash]["expertises"] = $_POST['expertises'];
            
            // On ajoute la référence validée à la liste "referralsValidated" dans le JSON
            $referentDecodedJson["referralsValidated"][] = $referralHash;
            // On converti la liste PHP en JSON
            $encoded_json = json_encode($referentDecodedJson, JSON_PRETTY_PRINT);
            // On sauvergade le JSON contenant les références du Référent
            file_put_contents($referentReferralsPath, $encoded_json);
        }
        else{
            echo "failed";
            exit;
        }

        // Chemin pour le fichier contenant les références du Jeune
        $juniorReferralsPath = __DIR__ . "/../database/juniors/" . $referentDecodedJson['referralsAll'][$referralHash]["juniorMail"] . "/referrals.json";
        if (file_exists($juniorReferralsPath)){
            // On ouvre le fichier JSON contenant les références du Jeune
            $jsonFile = file_get_contents($juniorReferralsPath);
            // On converti le JSON en une liste PHP
            $decoded_json = json_decode($jsonFile, true);
            
            if (!array_key_exists($referralHash, $decoded_json['referralsAll'])){
                $decoded_json['referralsAll'][$referralHash] = $referentDecodedJson['referralsAll'][$referralHash];
                $decoded_json['referralsSended'][] = $referralHash;
            }
           
            // On met à jour la référence pour le Jeune
            $decoded_json['referralsAll'][$referralHash]["validated"] = true;
            $decoded_json['referralsAll'][$referralHash]["read"] = false;
            if (isset($_POST['referentName'])){
                $decoded_json['referralsAll'][$referralHash]["referentName"] = $_POST['referentName'];
            }
            if (isset($_POST['referentFirstName'])){
                $decoded_json['referralsAll'][$referralHash]["referentFirstName"] = $_POST['referentFirstName'];
            }
            if (isset($_POST['referentBirthDate'])){
                $decoded_json['referralsAll'][$referralHash]["referentBirthDate"] = $_POST['referentBirthDate'];
            }
            if (isset($_POST['referentSocialMedias'])){
                $decoded_json['referralsAll'][$referralHash]["referentSocialMedias"] = $_POST['referentSocialMedias'];
            }
            $decoded_json['referralsAll'][$referralHash]["commentary"] = $_POST['commentary'];
            $decoded_json['referralsAll'][$referralHash]["expertises"] = $_POST['expertises'];
            // On ajoute la référence validée à la liste "referralsValidated" dans le JSON
            $decoded_json["referralsValidated"][] = $referralHash;

            // On converti la liste PHP en JSON
            $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);
            // On sauvergade le JSON contenant les références du Jeune
            file_put_contents($juniorReferralsPath, $encoded_json);

            exit;
        }
        else{
            echo "failed";
            exit;
        }

        echo "failed";
    }
?>