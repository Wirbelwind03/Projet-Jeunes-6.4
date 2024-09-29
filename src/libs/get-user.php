<?php 
    if(session_status() === 1){
        session_start();
    }

    // Récupère les données d'un utilisateur.
    // Permet aussi de vérifier si un utilisateur existe ou non
    
    // Chemin pour le fichier JSON de tous les utilisateurs
    $usersJsonPath = __DIR__ ."/../database/users.json";

    // On vérifie si le fichier existe
    if (file_exists($usersJsonPath)){

        // Ouvrir le fichier json
        $jsonFile = file_get_contents($usersJsonPath);

        // On converti le JSON en une liste PHP
        $usersJson = json_decode($jsonFile, true);
        
        // On récupère les arguments
        $userMail = $_POST['userMail'] ?? $_SESSION["user"]["mail"]; // On utilise le mail de la session si l'utilisateur n'a pas rentré d'arguments
        $userType = $_POST['userType'] ?? $_SESSION["type"]; // On utilise le module de la session si l'utilisateur n'a pas rentré d'arguments
    
        // Si l'utlisateur existe dans le json
        if (isset($usersJson[$userType][$userMail])){
            // On récupère l'utiisateur par son type et son mail
            $user = $usersJson[$userType][$userMail];
            echo json_encode($user); // On renvoie les données de l'utilisateur
            exit;
        }
    }

    echo "failed";
?>