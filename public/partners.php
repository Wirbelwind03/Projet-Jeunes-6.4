<?php 
    if (session_status() === 1) {
        session_start();
    }

    $css = array(
        'assets/styles/helper.css',
        'assets/styles/partners.css'
    );
    if (isset($_SESSION['type'])){
        array_push($css, "assets/styles/" . $_SESSION['type'] . ".css");
    }

    require_once __DIR__. "/../src/inc/head.php";
?>
<!-- Page contenant les images des partenaires -->
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="partners-container">
            <span>JEUNES 6.4 est un dispositif issu de la <b>charte de l'engagement</b> pour la jeunesse signée en 2013 par des partenaires institutionnels...</span>
            
            <div class="image-container">
                <div class="row">
                    <img src="assets/images/partners/rebublique_fr.png">
                    <img src="assets/images/partners/region_aquitaine.png">
                    <img src="assets/images/partners/pyrenees_atlantiques.png">
                    <img src="assets/images/partners/assurance_maladie.png">
                </div>
                <div class="row">
                    <img src="assets/images/partners/assises_de_la_jeunesse.png">
                    <img src="assets/images/partners/caf.png">
                    <img src="assets/images/partners/rmsa.png">
                    <img src="assets/images/partners/universite_de_pau_et_des_pays_de_l_adour.png">
                </div>
            </div>
            
            <span>...qui ont décidé de mettre en commun leurs actions pour les jeunes des Pyrénées-Atlantiques.</span>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>