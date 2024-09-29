<?php
    if(session_status() === 1){
        session_start();
    }

    // Met à jour la valeur "read" de la référence choisie
    
    $referralsJsonPath = __DIR__ . "/../database/" . $_SESSION["type"] . "/" . $_SESSION["user"]["mail"] . "/referrals.json";

    if (file_exists($referralsJsonPath))
    {
        if(!isset($_POST["referralHash"])){
            echo "failed";
            exit;
        }

        // On récupère les arguments
        $referralHash = $_POST["referralHash"];

        $referralsJsonFile = file_get_contents($referralsJsonPath);
        $decoded_json = json_decode($referralsJsonFile, true);
    
        // Change la valeur de "read" pour dire que l'utilisateur a lu la référence
        $decoded_json['referralsAll'][$referralHash]["read"] = true;

        $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);
        file_put_contents($referralsJsonPath, $encoded_json);

        echo $referralsJsonFile;
        exit;
    }

    echo "failed";
?>