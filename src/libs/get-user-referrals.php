<?php
    if(session_status() === 1){
        session_start();
    }

    // Récupère les références d'un utilisateur ou de l'utilisateur connectée
    
    // Récupère les arguments
    $userMail = $_POST['userMail'] ?? $_SESSION["user"]["mail"];
    $userType = $_POST['userType'] ?? $_SESSION["type"];
    
    // Chemin pour le JSON contenat les références de l'utilisateur
    $referralsJsonPath = __DIR__ . "/../database/" . $userType . "/" . $userMail . "/referrals.json";
    if (file_exists($referralsJsonPath)){
        // Ouvre le fichier JSON contenant les références
        $jsonFile = file_get_contents(__DIR__ . "/../database/" . $userType . "/" . $userMail . "/referrals.json");
        echo $jsonFile; // Renvoie le JSON contenant les références
        exit;
    }

    echo "failed";
?>