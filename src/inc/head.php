<?php
    if (session_status() === 1) {
        session_start();
    }

    // Change le mode clair/sombre de la balise <body>
    function getLightMode(){
        // Si la session n'existe pas, on met le mode clair
        // Si la session existe, on récupère le mode de la sessions
        echo isset($_SESSION['mode']) ? $_SESSION['mode'] : 'light';
    }

    // Récupère l'image pour le mode clair/sombre
    // iconName : Nom de l'image ( avec son chemin )
    function getLightModeImage($iconName){
        echo $iconName . "-" . (isset($_SESSION['mode']) ? $_SESSION['mode'] : 'light') . "mode.png";
    }
?>
<!-- Entête de la page -->
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/styles/common.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="assets/scripts/common.js"></script>
    <?php
        // Ajoute des fichier CSS additionnels dans l'entête
        if (isset($css))
            foreach ($css as $path)
                printf('<link rel="stylesheet" type="text/css" href="%s" />', $path);
        
        // Ajoute des fichier JS additionnels dans l'entête
        if (isset($js))
            foreach ($js as $path)
                printf('<script src="%s"></script>', $path);
    ?>
</head>
<body data-theme=<?php getLightMode() ?>>