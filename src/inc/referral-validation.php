<?php
    if (session_status() === 1) {
        session_start();
    }
?>
<div class="referral-validation">
    
    <!-- Button pour quitter le formulaire -->
    <button type="button" class="exit-button" title="Annuler">&times;</button>
    
    <div class="text-block">
        <h1><span class="register-type-header-text user-color">RÉFÉRENT</span></h1>
        <h2><span class="register-type-description-text">Je confirme la valeur de ton engagement</span></h2>
    </div>
    
    <div class="text-block">
        <span class="description user-color">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</span>
    </div>

    <form id="referral-validation-form">

        <!-- Onglet 1 : Où le référent regarde ses données personelles de l'engagement -->
        <div class="tab">
            <div class="block">
                <div class="form-group">
                    <label class="referents-color" for="referent-name">NOM :</label>
                    <input class="referents-border-color" type="text" name="referentName" id="referent-name" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="referents-color" for="referent-first-name">PRENOM :</label>
                    <input class="referents-border-color" type="text" name="referentFirstName" id="referent-first-name" class="form-control">
                </div>

                <div class="form-group">
                    <label class="referents-color" for="referent-birth-date">DATE DE NAISSANCE :</label>
                    <input class="referents-border-color" type="date" name="referentBirthDate" id="referent-birth-date" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="referents-color" for="referent-mail">Mail :</label>
                    <input class="referents-border-color" type="text" name="referentMail" id="referent-mail" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label class="referents-color" for="referent-social-medias">Réseau social :</label>
                    <input class="referents-border-color" type="text" name="referentSocialMedias" id="referent-social-medias" class="form-control">
                </div>
            </div>
        </div>
        
        <!-- Onglet 2 : Où le référent met son commentaire -->
        <div class="tab">
            
            <div class="referents-linear-gradient-type2 commentary block cut-bottom">
                <h1>COMMENTAIRES</h1>
            </div>
            
            <div class="referents-linear-gradient-type2 block cut-top">
                <textarea name="commentary" id="referent-commentary" rows="15" class="form-control"></textarea>
            </div>
            
        </div>
        
        <!-- Onglet 3 : Où le référent confirme les savoirs faire du Jeune -->
        <div class="tab">
            
            <div class="checkbox-header user-color user-border-color block cut-bottom">
                <h2 class="referents-color">SES SAVOIRS ETRE</h2>
            </div>
            
            <div class="referents-linear-gradient-type1 checkbox-description block cut-top cut-bottom">
                <h1>Je confirme sa (son)<span class="required">*</span></h1>
            </div>
            
            <!-- Conteneur qui contient les cases à cocher -->
            <div class="referents-linear-gradient-type2 block cut-top cut-bottom">
                <div class="checkbox-group">
                    <input type="checkbox" id="punctuality" name="expertises[]" id="punctuality" value="punctuality">
                    <label for="punctuality">Ponctualité</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="self-confidence" name="expertises[]" id="self-confidence" value="self-confidence">
                    <label for="self-confidence">Confiance</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="serious" name="expertises[]" id="serious" value="serious">
                    <label for="serious">Sérieux</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="honesty" name="expertises[]" id="honesty" value="honesty">
                    <label for="honesty">Honnêteté</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="tolerance" name="expertises[]" id="tolerance" value="tolerance">
                    <label for="tolerance">Tolérance</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="kindness" name="expertises[]" id="kindness" value="kindness">
                    <label for="kindness">Bienveillance</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="respect" name="expertises[]" id="respect" value="respect">
                    <label for="respect">Respect</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="fair" name="expertises[]" id="fair" value="fair">
                    <label for="fair">Juste</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="unbiased" name="expertises[]" name="unbiased" value="unbiased">
                    <label for="unbiased">Impartial</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="hardworking" name="expertises[]" name="hardworking" value="hardworking">
                    <label for="hardworking">Travail</label>
                </div>
            </div>
            <div class="checkbox-requirement block cut-margin-top">
                <span class="user-color" id="checkbox-requirement"><span class="required">*</span>Faire 4 choix maximum</span>
            </div>
        </div>
    
        <div class="form-button-group">
            <button type="button" class="previous-button form-button" id="previous-button">PREVIOUS</button>
            <div class="circle-steps">
                <span class="circle-step"></span>
                <span class="circle-step"></span>
                <span class="circle-step"></span>
            </div>
            <button type="button" name="create" class="next-button form-button" id="next-button">SUIVANT</button>
        </div>
    </form>

    <div class="block" id="referral-validated-message">
        <span class="user-color">Merci pour votre validation !</span>
    </div>
</div>