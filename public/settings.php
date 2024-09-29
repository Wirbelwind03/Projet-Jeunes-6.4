<?php 
    if(session_status() === 1){
        session_start();
    }

    if (!isset($_SESSION['loggedin'])){
        header("Location: /../public/home.php");
    }

    $css = array(
        'assets/styles/settings.css',
        'assets/styles/helper.css', 
    );
    if (isset($_SESSION['type'])){
        array_push($css, "assets/styles/" . $_SESSION['type'] . ".css");
    }

    $js = array(
        'assets/scripts/tab.js',
        'assets/scripts/settings.js'
    );
    
    require_once __DIR__. "/../src/inc/head.php";
    
?>
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="settings-container">
            <div class="block settings-header">
                <img src="<?php getUserProfilPicture() ?>" class="profil-picture logged-in" width="64px" height="64px">
                <div class="settings-header-name">
                    <span><?php echo $_SESSION['user']['name'] ?> <?php echo $_SESSION['user']['firstname'] ?></span>
                    <span class="user-type user-color"><?php getUserType() ?></span>
                </div>
            </div>
            
            <div class="block settings-layout">
                <div class="settings-layout-sidebar">
                    <div class="tabs-container">
                        <div class="block cut-top cut-border-left cut-border-right cut-bottom">
                            <button type="button" class="tab-button" id="tab1"><h3>PROFIL</h3></button>
                        </div>
                        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "juniors") : ?>
                            <div class="block cut-border-left cut-border-right cut-margin-top">
                                <button type="button" class="tab-button" id="tab2"><h3>MES SAVOIRS ETRE</h3></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="settings-layout-main block cut-top cut-bottom cut-margin-left cut-border-right">
                    <form method="post" id="settings-form">
                        <div class="tab-content" id="tab1-content">
                            <h2 class="user-color">Votre profil</h2>
                            <div class="test">
                                <div class="settings-profil">
                                    <div class="settings-group">
                                        <span class="user-color">NOM : </span><span><?php echo $_SESSION['user']['name'] ?></span>
                                    </div>
                                    
                                    <div class="settings-group">
                                        <span class="user-color">PRENOM : </span><span><?php echo $_SESSION['user']['firstname'] ?></span>
                                    </div>
                                    
                                    <div class="settings-group column">
                                        <label class="user-color">DATE DE NAISSANCE : </label>
                                        <input class="user-border-color" type="date" name="birthDate" id="birth-date"></input>
                                    </div>
                                    
                                    <div class="settings-group column">
                                        <label class="user-color">MAIL : </label>
                                        <input class="user-border-color" type="mail" name="mail" id="mail"></input>
                                    </div>

                                    <div class="settings-group column">
                                        <label class="user-color">Nouveau Mot de Passe : </label>
                                        <input type="password" class="user-border-color" name="newPassword" id="new-password"></input>
                                    </div>

                                    <div class="settings-group column">
                                        <label class="user-color">Confirmer le nouveau Mot de Passe : </label>
                                        <input type="password"  class="user-border-color" name="confirmNewPassword" id="confirm-new-password"></input>
                                    </div>

                                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "referents") : ?>
                                        <div class="settings-group column">
                                            <span class="user-color">Présentation :</span>
                                            <textarea name="presentation" id="presentation" rows="8" class="form-control"></textarea>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="profil-picture-edit">
                                    <img src="<?php getUserProfilPicture() ?>" class="profil-picture logged-in" width="128px" height="128px">
                                    <input class="hide" type="file" id="imageFile" name="imageFile">
                                    <div class="loader" id="modify-profil-picture-loader"></div>
                                    <button type="button" class="user-color" id="modify-profil-picture-button" value="Modifier">MODIFIER</button>
                                </div>
                            </div>
                            
                        </div>
                        
                        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "juniors") : ?>
                            <div class="tab-content" id="tab2-content">
                                <h2 class="user-color">Vos savoirs êtres</h2>
                                <div class="settings-checkboxes-container juniors-linear-gradient-type2">
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
                                <div class="checkbox-requirement block">
                                    <span class="user-color" id="checkbox-requirement"><span class="required">*</span>Faire 4 choix maximum</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </form>
                    <div class="loader" id="save-settings-loader"></div>
                    <button type="button" class="form-button" id="save-settings" >SAUVEGARDER</button>
                </div>
            </div>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>