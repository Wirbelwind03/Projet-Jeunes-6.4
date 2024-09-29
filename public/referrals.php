<?php 
    if(session_status() === 1){
        session_start();
    }

    if (!isset($_SESSION['loggedin'])){
        header("Location: /../public/home.php");
    }

    $css = array(
        'assets/styles/helper.css', 
        'assets/styles/referrals.css',
        'assets/styles/profil-card.css'
    );
    if (isset($_SESSION['type'])){
        array_push($css, "assets/styles/" . $_SESSION['type'] . ".css");
    }

    $js = array(
        "https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.1/purify.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js",
    
        "assets/scripts/form-tab.js",
        "assets/scripts/tab.js",
        "assets/scripts/profil-card.js",
        "assets/scripts/send-to-consultant.js",
        "assets/scripts/referral-validation.js",
        "assets/scripts/referral-content.js",
        "assets/scripts/referrals.js"
    );
    require_once __DIR__. "/../src/inc/head.php"; 
?>
<div id="wrap">
    <!-- Barre de navigateur -->
    <?php include __DIR__. "/../src/inc/header.php"?>
    
    <!-- Barre de chargement pour la page entière -->
    <div class="loader" id="wrap-loader"></div>
    
    <main>
        <div class="referrals-container">
            
            <!-- Contient les onglets pour choisir les différent type de références -->
            <div class="block referrals-sidebar cut-margin-left cut-border-right">
                
                <!-- Contient les onglets -->
                <div class="tabs-container">
                    
                    <!-- Permet à un utilisateur Jeune de créer une nouvelle référence -->
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "juniors") : ?>
                        <a href="referral-request.php" class="create-button"><h3>Créer une référence</h3></a>
                    <?php endif; ?>

                    <!-- Affiche tous les références -->
                    <button type="button" class="tab-button" id="referralsAll"><h3>Références</h3></button>
                    
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] != "consultants") : ?>
                        <button type="button" class="tab-button" id="referralsSended"><h3>Références en attentes</h3></button>
                        <button type="button" class="tab-button" id="referralsValidated"><h3>Références validées</h3></button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Contient tous ce qui est liée aux références -->
            <div class="block referrals-main cut-margin-left cut-border-right-radius">
                
                <!-- Barre de chargement pour la page contenant les références -->
                <div class="loader" id="main-loader"></div>
                
                <!-- Afficher les options pour la référence -->
                <div class="referrals-header">
                    <div id="referrals-header-content-options">
                        <ul>
                            <li class="option-back"><button type="button" title="Retourner aux références"><img src=<?php getLightModeImage("assets/images/return") ?> width="16px" height="16px"></button></li>
                            <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "juniors") : ?>
                                <li class="option-send-to-consultant"><button type="button" title="Envoyer à un consultant"><img src=<?php getLightModeImage("assets/images/send-to-consultant") ?> width="16px" height="16px"></button></li>
                                <li class="option-export-to-pdf"><button type="button" title="Exporter au format PDF"><img src=<?php getLightModeImage("assets/images/pdf") ?> width="16px" height="16px"></button></li>
                                <li class="option-export-to-html"><button type="button" title="Exporter au format HTML"><img src=<?php getLightModeImage("assets/images/html") ?> width="16px" height="16px"></button></li>
                            <?php endif; ?>
                            <li class="option-delete"><button type="button" title="Supprimer"><img src=<?php getLightModeImage("assets/images/bin") ?> width="16px" height="16px"></button></li>
                        </ul>
                    </div>

                    
                </div>
                
                <!-- Affiche toutes les références -->
                <div class="referral-list">
                    <table class="referrals-table">
                        <tbody id="referrals">

                        </tbody>
                    </table>
                </div>
                
                <!-- Afficher le contenu de la référence -->
                <?php include __DIR__. "/../src/inc/referral-content.php"?>
            </div>
        </div>
        
        <!-- Recouvrir la page d'un fond noir transparent -->
        <div id="overlay">
        </div>
        
        <!-- Afficher le formulaire pour la validation -->
        <?php include __DIR__. "/../src/inc/referral-validation.php"?>
        
        <!-- Afficher le formulaire pour envoyer au consultant -->
        <?php include __DIR__. "/../src/inc/send-to-consultant.php"?>
        
        <!-- Afficher le profil d'un utilisateur -->
        <?php include __DIR__. "/../src/inc/profil-card.php"?>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>