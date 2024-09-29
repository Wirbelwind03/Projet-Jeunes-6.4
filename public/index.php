<?php
    if(session_status() === 1){
        session_start();
    }

    $css = array(
        'assets/styles/helper.css', 
        'assets/styles/index.css'
    );
    if (isset($_SESSION['type'])){
        array_push($css, "assets/styles/" . $_SESSION['type'] . ".css");
    }

    require_once __DIR__. "/../src/inc/head.php"; 
?>
<!-- Page d'accueil -->
<div id="wrap">
    <main>
        <div class="index-container">
            <div id="title">
                <h1 class="colored">Pour faire de l'engagement</h1>
                <h1 class="colored">une valeur !</h1>
            </div>
            
            <img src="assets/images/jeunes64icon.png">
            
            <h2 class="colored">... l'expression d'un potentiel, <br>
            la promesse d'une richesse !
            </h2>
            
            <a class="colored" href="home.php">ENTRER</a>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>