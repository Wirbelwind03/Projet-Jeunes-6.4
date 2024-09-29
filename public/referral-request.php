<?php 
    if(session_status() === 1){
        session_start();
    }

    if (!isset($_SESSION['loggedin'])){
        header("Location: /../public/home.php");
    }

    $css = array(
        'assets/styles/helper.css', 
        'assets/styles/juniors.css',
        'assets/styles/referral-request.css'
    );
    $js = array(
        'assets/scripts/tab.js',
        'assets/scripts/referral-request.js'
    );
    require_once __DIR__. "/../src/inc/head.php"; 
?>
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="reference-request-container">
            <div class="text-block">
                <h1><span class="register-type-header-text juniors-color">DEMANDE DE REFERENCE</span></h1>
                <h2><span class="register-type-description-text">Je donne de la valeur à mon engagement</span></h2>
            </div>

            <div class="block">
                <span class="description user-color">Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</span>
            </div>
            
            <div class="block">

                <!-- Formulaire pour la demande de référence -->
                <form method="post" id="referral-request-form">

                    <!-- Conteneur pour ce qui est lié au Référent -->
                    <div>
                        <div class="block block-label referents-border-color cut-bottom">
                            <h2><span class="register-type-header-text referents-color">LE RÉFÉRENT</span></h2>
                        </div>
                        
                        <div class="block referents-border-color cut-margin-top">
                            <div class="form-group">
                                    <label class="referents-color" for="referent-name">NOM <span class="required">*</span> :</label>
                                    <input class="referents-border-color" type="text" name="referentName" id="referent-name" class="form-control" placeholder="Nom du référent">
                            </div>
                            
                            <div class="form-group referents-color">
                                    <label class="referents-color" for="referent-first-name">PRENOM <span class="required">*</span> :</label>
                                    <input class="referents-border-color" type="text" name="referentFirstName" id="referent-first-name" class="form-control" placeholder="Prénom du référent">
                            </div>

                            <div class="form-group referents-color">
                                    <label class="referents-color" for="referent-birth-date">DATE DE NAISSANCE :</label>
                                    <input class="referents-border-color" type="date" name="referentBirthDate" id="referent-birth-date" class="form-control" placeholder="Date de naissance du référent">
                            </div>
                            
                            <div class="form-group referents-color">
                                    <label class="referents-color" for="referent-mail">Mail <span class="required">*</span> :</label>
                                    <input class="referents-border-color" type="mail" name="referentMail" id="referent-mail" class="form-control" placeholder="Email du référent">
                            </div>

                            <div class="form-group referents-color">
                                    <label class="referents-color" for="referent-social-medias">Réseau social :</label>
                                    <input class="referents-border-color" type="text" name="referentSocialMedias" id="referent-social-medias" class="form-control" placeholder="Réseaux sociaux du référent">
                            </div>
                        </div>
                    </div>

                    <!-- Conteneur ou le Jeune entre tous ce qui lié à la référence -->
                    <div>
                        <div class="tabs-container">
                            <div class="block block-tab-label cut-bottom">
                                <button type="button" class="tab-button" id="tab1"><h2 class="register-type-header-text user-color">DESCRIPTION</h2></button>
                            </div>
                            
                            <div class="block block-tab-label cut-bottom">
                                <button type="button" class="tab-button" id="tab2"><h2 class="register-type-header-text user-color" id="juniors-skills-tab-text">SAVOIRS ETRES <span class="required">*</span></h2></button>
                            </div>
                        </div>
                        
                        <div class="cut-margin-top">

                            <!-- Onlget 1 :  -->
                            <div class="block cut-margin-top tab-content" id="tab1-content">
                                <div class="form-group">
                                    <label class="juniors-color" for="commitment">MON ENGAGEMENT <span class="required">*</span> :</label>
                                    <textarea class="juniors-border-color" name="commitment" id="commitment" rows="8" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="juniors-color" for="duration">DUREE <span class="required">*</span> :</label>
                                    <input class="juniors-border-color" type="text" name="duration" id="duration" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="juniors-color" for="environment">MILIEU <span class="required">*</span> :</label>
                                    <input class="juniors-border-color" type="text" name="environment" id="environment" class="form-control">
                                </div>
                            </div>
                            
                            <!-- Onglet 2 :  -->
                            <div class="tab-content" id="tab2-content">
                                <div class="juniors-linear-gradient-type1 checkbox-description block cut-top cut-bottom">
                                    <h1>Je suis<span class="required">*</span></h1>
                                </div>
                                <div class="block juniors-linear-gradient-type2 cut-top cut-bottom">
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="autonomous" name="skills[]" value="autonomous">
                                        <label for="autonomous">Autonome</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="capable" name="skills[]" value="capable">
                                        <label for="capable">Capable d'analyse et de synthèse</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="listening" name="skills[]" value="listening">
                                        <label for="listening">A l'écoute</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="organized" name="skills[]" value="organized">
                                        <label for="organized">Organisé</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="passionate" name="skills[]" value="passionate">
                                        <label for="passionate">Passionée</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="reliable" name="skills[]" value="reliable">
                                        <label for="reliable">Fiable</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="patient" name="skills[]" value="patient">
                                        <label for="patient">Patient</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="thoughtful" name="skills[]" value="thoughtful">
                                        <label for="thoughtful">Réfléchi</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="responsible" name="skills[]" value="responsible">
                                        <label for="responsible">Responsable</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="sociable" name="skills[]" value="sociable">
                                        <label for="sociable">Sociable</label>
                                    </div>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="optimistic" name="skills[]" value="optimistic">
                                        <label for="optimistic">Optimiste</label>
                                    </div>
                                </div>
                                <div class="checkbox-requirement block cut-margin-top">
                                    <span class="juniors-color" id="checkbox-requirement"><span class="required">*</span>Faire 4 choix maximum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Barre de chargement pour le button "Envoyer la demande de référence" -->
            <div class="loader" id="send-loader"></div>
            <!-- Button pour envoyer la demande de référence -->
            <button type="button" class="form-button" id="send-button">ENVOYER</button>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>