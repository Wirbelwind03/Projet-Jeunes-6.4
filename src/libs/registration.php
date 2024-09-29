<?php
    if(session_status() === 1){
        session_start();
    }

    // Inscrit un Jeune dans le site
    
    $usersJsonPath = __DIR__ . "/../database/users.json";
    if (file_exists($usersJsonPath))
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // Ouvir le fichier JSON contenant les utilisateurs
            $usersJsonFile = file_get_contents($usersJsonPath);
            
            // On récupère les informations du formulaire
            $newJunior = array(
                "name" => strtoupper($_POST['name']),
                "firstname" => ucfirst($_POST['firstname']),
                "birthDate" => $_POST['birthDate'],
                "mail" => $_POST['mail'],
                "password" => $_POST["password"],
                "socialMedias" => $_POST['socialmedias'],
                "skills" => $_POST['skills']
            );

            // Converti le JSON en une liste php
            $decoded_json = json_decode($usersJsonFile, true);

            // Vérifie si l'email n'est pas déjà pris
            if (!array_key_exists($newJunior["mail"], $decoded_json["juniors"]))
            {
        
                // Ajoute le nouveau mail dans l'objet "juniors"
                $decoded_json['juniors'][$newJunior["mail"]] = $newJunior;
                
                // Convertir la liste php en json
                $encoded_json = json_encode($decoded_json, JSON_PRETTY_PRINT);
        
                // Ecrire le nouveau utilisateur dans le fichier JSON
                file_put_contents(__DIR__ . "/../database/users.json", $encoded_json);

                // Créer le dossier pour l'utilisateur
                if (!is_dir(__DIR__ . "/../database/juniors/" . $newJunior["mail"])) {
                    mkdir(__DIR__ . "/../database/juniors/" . $newJunior["mail"], 0777, true);
                }
        
                // Création de la base de données des références pour l'utilisateur
                $referralsData = array(
                    "referralsAll" =>  (object)array(),
                    "referralsSended" => array(),
                    "referralsValidated" => array()
                );
                
                // Converti la liste PHP en JSON
                $referralsJson = json_encode($referralsData, JSON_PRETTY_PRINT);
                
                // Ecrire le fichier JSON contenant les références
                file_put_contents(__DIR__ . "/../database/juniors/" . $newJunior["mail"] . "/referrals.json", $referralsJson);
                
                // Connecter le nouveau utilisateur
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $newJunior; 
                $_SESSION['type'] = "juniors";

                exit;
            }

            echo "2";
        }
    }

    echo "1";
?>