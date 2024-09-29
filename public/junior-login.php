<?php 
    if(session_status() === 1){
        session_start();
    }

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("Location: /../public/profil.php");
    }

    $css = array(
        'assets/styles/juniors.css',
        'assets/styles/login.css'
    );
    
    $js = array(
        'assets/scripts/login.js'
    );

    require_once __DIR__. "/../src/inc/head.php";
?>
<!-- Formulaire pour se connecter à un compte Jeune -->
<div id="wrap">
    <!-- Barre navigateur -->
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="login-container" id="juniors">
            <div class="text-block">
                <h2><span class="register-type-description-text">Connectez vous à votre compte</span></h2>
                <h1><span class="register-type-header-text user-color">JEUNE</span></h1>
            </div>
            
            <!-- Formulaire pour se connecter -->
            <?php include __DIR__. "/../src/inc/login-form.php"?>
            
            <div class="ask-account block">
                <span class="description user-color">Première visite ?</span>
                <a href="registration.php"><button class="form-button">Créer un compte</button></a>
            </div>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>