<?php
    if (session_status() === 1) {
        session_start();
    }
?>
<!-- Formulaire qui montre les informations d'un utilisateur -->
<div class="profil-card-container">
    <button type="button" class="exit-button" title="Annuler">&times;</button>
    <div class="profil-card-main">
        
        <!-- Entête du profile -->
        <div class="profil-card-header block user-type-border-color">
            <img class="profil-card-profil-picture profil-picture logged-in" width="64px" height="64px"></img>
            <div class="profil-card-header-name">
                <span class="profil-card-name user-type-color"></span>
                <span class="profil-card-first-name user-type-color"></span>
            </div>
        </div>
        
        <!-- Corps du profile -->
        <div class="block user-type-border-color">
            <div class="profil-information-group"><span class="user-type-color">NOM : </span><span class="profil-card-name"></span></div>
            <div class="profil-information-group"><span class="user-type-color">PRENOM : </span><span class="profil-card-first-name"></span></div>
            <div class="profil-information-group"><span class="user-type-color">DATE DE NAISSANCE : </span><span class="profil-card-birth-date"></span></div>
            <div class="profil-information-group"><span class="user-type-color">Mail : </span><span class="profil-card-mail"></span></div>
            <div class="profil-information-group"><span class="user-type-color">Réseau social : </span><span class="profil-card-social-medias"></span></div>
        </div>

    </div>
</div>