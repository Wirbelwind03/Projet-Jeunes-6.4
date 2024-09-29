<?php 
    if(session_status() === 1){
        session_start();
    }

    if (!isset($_SESSION['loggedin'])){
        header("Location: /../public/home.php");
    }

    $css = array(
        'assets/styles/helper.css', 
        'assets/styles/profil.css',
    );
    if (isset($_SESSION['type'])){
        array_push($css, "assets/styles/" . $_SESSION['type'] . ".css");
    }
        
    require_once __DIR__. "/../src/inc/head.php";
?>
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="profil-container">

            <!-- Haut de page qui montre la photo de profil, le nom et le prénom de l'utilisateur connectée -->
            <div class="block profil-header">

                <!-- Photo de profil de l'utilisateur -->
                <img src="<?php getUserProfilPicture() ?>" class="profil-picture logged-in" width="64px" height="64px"></img>
                
                <!-- Nom et prénom de l'utilisateur -->
                <div class="profil-header-name">
                    <span><?php echo $_SESSION['user']['name'] ?> <?php echo $_SESSION['user']['firstname'] ?></span>
                    <span class="user-type user-color"><?php getUserType() ?></span>
                </div>

            </div>
            
            <!-- Option pour modifier le profil -->
            <div class="block cut-margin-bottom">
                <span><a href="settings.php">Modifier le profil</a></span>
            </div>

            <!-- Option pour regarder les références -->
            <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "juniors") : ?>

                <!-- Les références qu'à écrit le Jeune -->
                <div class="block cut-top cut-margin-bottom">
                    <span><a href="referrals.php">Mes références</a></span>
                </div>
            <?php else : ?>

                <!-- Les références qui sont réçues par les Référents/Consultants -->
                <div class="block cut-top">
                    <span><a href="referrals.php">Références réçues</a></span>
                </div>
            <?php endif; ?>
            
            <!-- Permettre à un utilisateur Jeune de créer une nouvelle référence -->
            <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "juniors") : ?>
                <div class="block cut-top cut-margin-bottom">
                    <span><a href="referral-request.php">Créer une demande de référence</a></span>
                </div>
            <?php endif; ?>
            
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>