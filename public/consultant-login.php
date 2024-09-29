<?php 
    if(session_status() === 1){
        session_start();
    }

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("Location: /../public/profil.php");
    }

    $css = array(
        'assets/styles/consultants.css',
        'assets/styles/login.css'
    );
    
    $js = array(
        'assets/scripts/login.js'
    );
    
    require_once __DIR__. "/../src/inc/head.php";
?>
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <!-- Conteneur contant le formulaire pour se connecter -->
        <div class="login-container" id="consultants">
            <div class="text-block">
                <h2><span class="register-type-description-text">Connectez vous à votre compte</span></h2>
                <h1><span class="register-type-header-text user-color">CONSULTANT</span></h1>
            </div>
            
            <!-- Formulaire pour se connecter -->
            <?php include __DIR__. "/../src/inc/login-form.php"?>

        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>