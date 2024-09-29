<?php
    if (session_status() === 1) {
        session_start();
    }
?>
<div class="send-to-consultant-form-container">
    <button type="button" class="exit-button" title="Annuler">&times;</button>
    <form method="post" class="block consultants-border-color" id="send-to-consultant-form">
        
        <!-- Saisie pour le nom du Consultant -->
        <div class="form-group">
            <label class="consultants-color" for="consultant-mail">NOM DU CONSULTANT :</label>
            <input class="consultants-border-color" type="text" name="consultantName" id="consultant-name" class="form-control">
        </div>

        <!-- Saisie pour le prénom du Consultant -->
        <div class="form-group">
            <label class="consultants-color" for="consultant-mail">PRENOM DU CONSULTANT :</label>
            <input class="consultants-border-color" type="text" name="consultantFirstName" id="consultant-first-name" class="form-control">
        </div>

        <!-- Saisie pour le mail du Consultant -->
        <div class="form-group">
            <label class="consultants-color" for="consultant-mail">MAIL DU CONSULTANT :</label>
            <input class="consultants-border-color" type="text" name="consultantMail" id="consultant-mail" class="form-control">
        </div>
        
        <!-- Barre de chargement pour le button "Envoyer" -->
        <div class="loader" id="send-to-consultant-button-loader" width="16px" height="16px"></div>
        <button type="button" class="form-button" id="send-to-consultant-button">ENVOYER</button>
    </form>
</div>