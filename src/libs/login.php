<?php
    if(session_status() === 1){
        session_start();
    }

    // Fait connecter l'utilisateur après qu'il ait completer le formulaire

    $usersJsonPath = __DIR__ ."/../database/users.json";
    if (file_exists($usersJsonPath))
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // On récupère les informations du formulaire
            $userType = $_POST['userType'];
            $loginMail = $_POST['mail'];
            $loginPassword = $_POST['password'];
    
            // Ouvrir le fichier json
            $jsonFile = file_get_contents($usersJsonPath);
    
            // Convertir le fichier json en une liste php
            $usersJson = json_decode($jsonFile, true);
    
            // On récupère l'utilisateur grâce à son type et son mail
            $user = $usersJson[$userType][$loginMail];

            // Si l'utilisateur réussi à se connecter, on allume une nouvelle session
            if (isset($user) && $user['password'] === $loginPassword)
            {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user; 
                $_SESSION['type'] = $userType;
                exit;
            }
        }
    }
    
    echo "failed";
?>
