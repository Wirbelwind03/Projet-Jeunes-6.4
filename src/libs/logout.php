<?php 
    if(session_status() === 1){
        session_start();
    }

    // Déconnecte l'utilisateur

    // Enlève tous les variables de la session
    session_unset(); 

    // Détruit la session
    session_destroy();

    // Retourne à l'accueil
    header("Location: /../public/home.php");
?>