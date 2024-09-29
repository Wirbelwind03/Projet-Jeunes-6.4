<?php 
    $css = array(
        'assets/styles/helper.css', 
        'assets/styles/juniors.css',
        'assets/styles/register.css'
    );
    $js = array(
        'assets/scripts/form-tab.js',
        'assets/scripts/registration.js'
    );
    require_once __DIR__. "/../src/inc/head.php";
?>
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="registration-container">
            <div class="text-block">
                <h1><span class="register-type-header-text user-color">JEUNE</span></h1>
            </div>

            <div class="ask-account block" id="ask-account-exist-message">
                <span class="description user-color">Vous avez déjà un compte ?</span>
                <a href="junior-login.php"><button name="create" class="form-button">Connectez-vous</button></a>
            </div>

            <form method="post" id="myform">       
                <div class="tab">
                    <div class="block">
                        <div class="form-group">
                            <label class="user-color" for="name">NOM <span class="required">*</span> :</label>
                            <input class="user-border-color" type="text" name="name" id="name" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label class="user-color" for="firstname">PRENOM <span class="required">*</span> :</label>
                            <input class="user-border-color" type="text" name="firstname" id="firstname" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label class="user-color" for="birthdate">DATE DE NAISSANCE <span class="required">*</span> :</label>
                            <input class="user-border-color" type="date" name="birthDate" id="birthdate" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="user-color" for="mail">Mail <span class="required">*</span> :</label>
                            <input class="user-border-color" type="text" name="mail" id="mail" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="user-color" for="password">Mot de passe <span class="required">*</span> :</label>
                            <input class="user-border-color" type="password" name="password" id="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="user-color" for="confirm-password">Confirmer le mot de passe <span class="required">*</span> :</label>
                            <input class="user-border-color" type="password" name="confirm-password" id="confirm-password" class="form-control">
                        </div>
        
                        <div class="form-group">
                            <label class="user-color" for="socialmedias">Réseau social :</label>
                            <input class="user-border-color" type="text" name="socialmedias" id="socialmedias" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="tab">
                    <div class="checkbox-header user-color user-border-color block cut-bottom">
                        <h2 class="juniors-color">MES SAVOIRS ETRE</h2>
                    </div>
                    <div class="juniors-linear-gradient-type1 checkbox-description block cut-top cut-bottom">
                        <h1>Je suis<span class="required">*</span></h1>
                    </div>
                    <div class="juniors-linear-gradient-type2 block cut-top cut-bottom">
                        <div class="checkbox-group">
                            <input type="checkbox" id="autonomous" name="skills[]" value="autonomous">
                            <label for="autonomous">Autonome</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="capable" name="skills[]" value="capable">
                            <label for="capable">Capable d"analyse et de synthèse</label>
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
                        <span class="user-color" id="checkbox-requirement"><span class="required">*</span>Faire 4 choix maximum</span>
                    </div>
                </div>
                
                <div class="form-button-group">
                    <button type="button" name="create" class="previous-button form-button" id="previous-button">PREVIOUS</button>
                    <div class="circle-steps">
                        <span class="circle-step"></span>
                        <span class="circle-step"></span>
                    </div>
                    <button type="button" name="create" class="next-button form-button" id="next-button">SUIVANT</button>
                </div>
            
                <div class="block" id="registration-end-message">
                    <span>Merci pour votre inscription</span><br>
                    <span>Vous allez être rediriger à la page d'accueil</span>
                </div>
            </form>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>