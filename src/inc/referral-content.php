<?php
    if (session_status() === 1) {
        session_start();
    }
?>
<div class="referral-content">
    <div class="referral-content-header">
        
        <!-- Affiche la photo de profil de celui qui a envoyé la référence -->
        <img id="referral-content-profil-picture" width="40" height="40"></img>
        
        <!-- Affiche les informations de envoyeur et receveur -->
        <div id="referral-content-header-sender-receiver">
            
            <!-- Affiche les informations du Jeune ( nom, prénom, email, profil ) -->
            <div id="referral-content-header-sender">
                <span id="referral-content-header-sender-name"></span>
                <span id="referral-content-header-sender-mail"></span>
                <?php if (isset($_SESSION['type']) && $_SESSION['type'] != "juniors") : ?>
                    <button type="button" class="option-see-profil" title="Voir le profil du Jeune" id="juniors-profil-card"><img src=<?php getLightModeImage("assets/images/user") ?> width="16px" height="16px"></button>
                <?php endif; ?>
            </div>
            
            <!-- Affiche les informations du Référent ( nom, prénom, email, profil ) ( seulement pour les consultants ) -->
            <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "consultants") : ?>
            <div id="referral-content-header-referent">
                <span>Pour <span class="referents-color" id="referral-content-header-referent-name"></span></span>
                <span id="referral-content-header-referent-mail"></span>
                <button type="button" class="option-see-profil" title="Voir le profil du référent" id="referents-profil-card"><img src=<?php getLightModeImage("assets/images/user") ?> width="16px" height="16px"></button>
            </div>
            <?php endif; ?>
            
            <!-- Affiche celui qui à récu la référence -->
            <div id="referral-content-header-receiver">
                <span>À <span id="referral-content-header-receiver-name"></span></span>
            </div>

        </div>
    </div> 

    <!-- Contenu de la référence ( engagement, durée, etc. ) -->
    <form id="juniors-referral-form">
        
        <!-- Présentation de la référence du Jeune -->
        <h3 class="juniors-color">MON ENGAGEMENT</h3>
        <p id="referral-text"></p>
        
        <h3 class="juniors-color">DUREE</h3>
        <span id="referral-duration"></span>
        
        <h3 class="juniors-color">MILIEU</h3>
        <span id="referral-environment"></span>
        
        <!-- Savoirs êtres montrée pendant cette engagement -->
        <div id="juniors-skills">
            <h3 class="juniors-color">MES SAVOIRS FAIRE</h3>
            <div class="block juniors-border-color juniors-linear-gradient-type2 referral-content-checkboxes" >
                <div class="juniors-color">
                    <div class="checkbox-group">
                        <input type="checkbox" id="autonomous" name="skills[]" value="autonomous" disabled>
                        <label for="autonomous">Autonome</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="capable" name="skills[]" value="capable" disabled>
                        <label for="capable">Capable d'analyse et de synthèse</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="listening" name="skills[]" value="listening" disabled>
                        <label for="listening">A l'écoute</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="organized" name="skills[]" value="organized" disabled>
                        <label for="organized">Organisé</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="passionate" name="skills[]" value="passionate" disabled>
                        <label for="passionate">Passionée</label>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="reliable" name="skills[]" value="reliable" disabled>
                        <label for="reliable">Fiable</label>
                    </div>
                </div>               
                
                <div class="juniors-color">
                    <div class="checkbox-group">
                        <input type="checkbox" id="patient" name="skills[]" value="patient" disabled>
                        <label for="patient">Patient</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="thoughtful" name="skills[]" value="thoughtful" disabled>
                        <label for="thoughtful">Réfléchi</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="responsible" name="skills[]" value="responsible" disabled>
                        <label for="responsible">Responsable</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="sociable" name="skills[]" value="sociable" disabled>
                        <label for="sociable">Sociable</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="optimistic" name="skills[]" value="optimistic" disabled>
                        <label for="optimistic">Optimiste</label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Montrer les informatins ajoutées par le Référent seulement pour le Consultant -->
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "consultants") : ?>
                
            <h3 class="referents-color">COMMENTAIRES</h3>
            <div class="referents-linear-gradient-type2 block">
                <textarea name="commentary" id="referent-commentary" rows="15" disabled></textarea>
            </div>

            <h3 class="referents-color">SES SAVOIRS ETRE</h3>
            <div class="block referents-border-color referents-linear-gradient-type2 referral-content-checkboxes" >
                <div class="referents-color">
                    <div class="checkbox-group">
                        <input type="checkbox" id="punctuality" name="expertises[]" id="punctuality" disabled>
                        <label for="punctuality">Ponctualité</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="self-confidence" name="expertises[]" id="self-confidence" disabled>
                        <label for="self-confidence">Confiance</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="serious" name="expertises[]" id="serious" disabled>
                        <label for="serious">Sérieux</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="honesty" name="expertises[]" id="honesty" disabled>
                        <label for="honesty">Honnêteté</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="tolerance" name="expertises[]" id="tolerance" disabled>
                        <label for="tolerance">Tolérance</label>
                    </div>
                </div>               
                
                <div class="referents-color">
                    <div class="checkbox-group">
                        <input type="checkbox" id="kindness" name="expertises[]" id="kindness" disabled>
                        <label for="kindness">Bienveillance</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="respect" name="expertises[]" id="respect" disabled>
                        <label for="respect">Respect</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="fair" name="expertises[]" id="fair" disabled>
                        <label for="fair">Juste</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="unbiased" name="expertises[]" name="unbiased" disabled>
                        <label for="unbiased">Impartial</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="hardworking" name="expertises[]" name="hardworking" disabled>
                        <label for="hardworking">Travail</label>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Button pour valider ou refuser cette engagement ( seulement pour les référents ) -->
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "referents") : ?>
            <input type="button" class="form-button" id="referral-validation-button" value="VALIDER">
        <?php endif; ?>
    </form>
</div>