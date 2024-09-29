<?php 
    if(session_status() === 1){
        session_start();
    }

    // Met à jour les préférences d'un utilisateur

    $usersJsonPath = __DIR__ ."/../database/users.json";
    if (file_exists($usersJsonPath)){
        $jsonFile = file_get_contents($usersJsonPath);
    
        // On convertit le JSON en une liste PHP
        $decodedJson = json_decode($jsonFile, true);
    
        // On récupère le mail et le type de l'utilisateur connectée
        $sessionEmail = $_SESSION['user']['mail'];
        $sessionUserType = $_SESSION["type"];

        // Vérifiez que l'utilisateur est dans la catégorie
        if (isset($_POST['skills'])) 
        {
            // Mettre à jour les "skills" de l'utilisateur
            $decodedJson[$sessionUserType][$sessionEmail]['skills'] = $_POST['skills'];
        }

        if (isset($_POST["birthDate"])){
            // Mettre à jour la date de naissance de l'utilisateur
            $decodedJson[$sessionUserType][$sessionEmail]['birthDate'] = $_POST["birthDate"];
        }

        if (isset($_POST["newPassword"]) && !empty($_POST["newPassword"])){
            // Mettre à jour le mot de passe de l'utilisateur
            $decodedJson[$sessionUserType][$sessionEmail]['password'] = $_POST["newPassword"];
        }

        if (isset($_POST["presentation"]) && $_SESSION['type'] == "referents")
        {
            // Mettre à jour la présentation pour le référent
            $decodedJson[$sessionUserType][$sessionEmail]['presentation'] = $_POST["presentation"];
        }

        // Mettre à jour le nouveau email
        if (isset($_POST["mail"])){
            $newEmail = $_POST["mail"];
            
            // On véfirie si l'email existe dans la base de données (ET si c'est égale à l'email de la session, on ignore)
            if (array_key_exists($newEmail, $decodedJson[$sessionUserType]) && ($newEmail !== $sessionEmail)){
                // On renvoie l'erreur "L'email existe déjà dans la base de données"
                echo "2"; 
                exit;
            }

            if ($newEmail !== $sessionEmail){
                // Mettre le nouveau email dans le json
                $decodedJson[$sessionUserType][$newEmail] = $decodedJson[$sessionUserType][$sessionEmail];
                // Mettre à jour la valuer "mail" du nouveau email
                $decodedJson[$sessionUserType][$newEmail]["mail"] = $newEmail;
                
                // Changer le nom du dossier pour l'utilsateur
                $referralsOldEmailJsonPath = __DIR__ . "/../database/" . $sessionUserType . "/" . $sessionEmail;
                $referralsNewEmailJsonPath = __DIR__ . "/../database/" . $sessionUserType . "/" . $newEmail;
                if (!rename($referralsOldEmailJsonPath, $referralsNewEmailJsonPath)) {
                    // Si le dossier n'a pas été renommer correctement, on envoie une erreur
                    echo "1";
                    exit;
                } 

                // Supprimer l'ancien email
                unset($decodedJson[$sessionUserType][$sessionEmail]);

                // Changer le mail de la session
                $_SESSION['user']['mail'] = $newEmail;
            }
        }

        // On convertit la liste php en JSON
        $encodedJson = json_encode($decodedJson, JSON_PRETTY_PRINT);

        // On met à jour le fichier JSON qui contient tous les utilisateur
        file_put_contents(__DIR__. "/../database/users.json", $encodedJson);

        exit;
    }

    echo "1";
?>