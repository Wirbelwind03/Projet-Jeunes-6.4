<?php
    if (session_status() === 1) {
        session_start();
    }
?>
<!-- Formulaire pour se connecter -->
<form method="post" class="block" id="myform">

    <!-- Saisie pour le mail -->
    <div class="form-group">
        <label class="user-color" for="mail">MAIL :</label>
        <input class="user-border-color" type="text" name="mail" id="mail" class="form-control">
    </div>

    <!-- Saisie pour le mot de passe -->
    <div class="form-group">
        <label class="user-color" for="password">MOT DE PASSE :</label>
        <input class="user-border-color" type="password" name="password" id="password" class="form-control">
    </div>
    
    <!-- Barre de chargement pour la connexion -->
    <div class="loader" width="16px" height="16px"></div>

    <!-- Button pour se connecter -->
    <button type="button" class="form-button" name="login-user" id="login-button">CONNEXION</button>
</form>