<?php 
    if(session_status() === 1){
        session_start();
    }

    // Change le mode clair/sombre d'un utilisateur pour sa session

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Si la session n'existe pas, on met le mode clair
        // Si la session existe, on récupère le mode de la sessions
        $mode = isset($_SESSION['mode']) ? $_SESSION['mode'] : 'light';

        // On change le mode dans la session
        if (isset($_POST['mode'])){
            $mode = $_POST['mode'];
            $_SESSION['mode'] = $mode;
        }

        exit;
    }
?>