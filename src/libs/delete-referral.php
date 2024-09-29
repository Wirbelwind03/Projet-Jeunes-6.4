<?php
    if(session_status() === 1){
        session_start();
    }

    // Récupère les arguments
    $referralHash = $_POST["referralHash"];
    $userMail = $_POST['userMail'] ?? $_SESSION["user"]["mail"];
    $userType = $_POST['userType'] ?? $_SESSION["type"];
    
    $referralsJsonPath = __DIR__ . "/../database/" . $userType . "/" . $userMail . "/referrals.json";
    // Vérifie si le fichier pour les références existe
    if (file_exists($referralsJsonPath)){
        
        // Ouvrir le fichier JSON
        $jsonFile = file_get_contents(__DIR__ . "/../database/" . $userType . "/" . $userMail . "/referrals.json");

        // Converti le fichier JSON en une liste PHP
        $decoded_json = json_decode($jsonFile, true);

        if (isset($decoded_json["referralsAll"]) && array_key_exists($referralHash, $decoded_json["referralsAll"])){
            unset($decoded_json["referralsAll"][$referralHash]);
        }

        // Supprime le hashage dans la liste "referralsSended"
        if (isset($decoded_json["referralsSended"]) && in_array($referralHash, $decoded_json["referralsSended"])){
            $decoded_json['referralsSended'] = array_values(array_diff($decoded_json['referralsSended'], [$referralHash]));
        }

        // Supprime le hashage dans la liste "referralsReceived"
        if (isset($decoded_json["referralsReceived"]) && in_array($referralHash, $decoded_json["referralsReceived"])){
            $decoded_json['referralsReceived'] = array_values(array_diff($decoded_json['referralsReceived'], [$referralHash]));
        }

        // Supprime le hashage dans la liste "referralsValidated"
        if (isset($decoded_json["referralsValidated"]) && in_array($referralHash, $decoded_json["referralsValidated"])){
            $decoded_json['referralsValidated'] = array_values(array_diff($decoded_json['referralsValidated'], [$referralHash]));
        }

        // Converti la liste PHP en un JSON
        $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);

        // Sauvergade les nouvelles données dans le JSON
        file_put_contents($referralsJsonPath, $encoded_json);

        exit;
    }

    echo "failed";
    exit;
?>