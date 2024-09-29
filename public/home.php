<?php
    if(session_status() === 1){
        session_start();
    }

    $css = array(
        'assets/styles/home.css',
        'assets/styles/helper.css', 
    );
    if (isset($_SESSION['type'])){
        array_push($css, "assets/styles/" . $_SESSION['type'] . ".css");
    }

    require_once __DIR__. "/../src/inc/head.php"; 
?>
<!-- Page d'accueil -->
<div id="wrap">
    <?php include __DIR__. "/../src/inc/header.php"?>
    <main>
        <div class="home-container">

            <!-- Montre un message d'accueil pour l'utilisateur connectée -->
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                <div class="block welcome-message">
                    <!-- Montre le nom et prénom de l'utilisateur -->
                    <span> Bienvenue <span class="user-color"><?php echo $_SESSION['user']['name'] ?> <?php echo $_SESSION['user']['firstname'] ?></span></span>
                </div>
            <?php endif; ?> 
            
            <h1>De quoi s'agit-il ?</h1>
            <p class="description">
                <b>A vous, jeunes entre 16 et 30 ans,</b> 
                qu'un engagement quel qu'il soit puisse être considérer à sa juste valeur !
                Toute expérience est source d'enrichissement et doit d'être reconnu largement.
                Elle révèle un potentiel, l'expression d'un savoir-être à concrétiser.
            </p>

            <h1>A qui s'adresse-t'il ?</h1>
            <p class="description">
                <b>D'une opportunité :</b> 
                qui vous êtes investis spontanément dans une association ou dans tout type d'action formelle ou informelle, et qui avez partagé de votre temps, de votre énergie, pour apporter un soutien, une aide, une compétence.
            </p>

            <p class="description">
                <b>A vous, responsables de structures ou référents d'un jour,</b> 
                qui avez croisé la route de ces jeunes et avez bénéficié même ponctuellement de cette implication citoyenne !
                C'est l'occasion de vous engager à votre tour pour ces jeunes en confir- mant leur richesse pour en avoir été un temps les témoins mais aussi les bénéficiaires ! 
            </p>

            <p class="description">
                <b>A vous, employeurs, recruteurs en ressources humaines, représentants d'organismes de formation,</b> 
                qui recevez ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-être constitue le premier fondement de toute capacité humaine. 
            </p>

            <h2>Cet engagement est une ressource à valoriser au fil d'un parcours en 3 étapes :</h2>

            <div class="commitment-steps-container">
                <div class="description-box juniors-border-color" id="description-box-juniors">
                    <span class="juniors-border-color juniors-linear-gradient-type1">1ère étape<br>la valorisation</span>
                    <span class="juniors-linear-gradient-type2">Décrivez votre expérience et mettez en avant ce que vous en avez retiré</span>
                </div>
                <div class="description-box referents-border-color" id="referents-box-juniors">
                    <span class="referents-border-color referents-linear-gradient-type1">2ème étape<br>la confirmation</span>
                    <span class="referents-linear-gradient-type2">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune</span>
                </div>
                <div class="description-box consultants-border-color" id="consultants-box-juniors">
                    <span class="consultants-border-color consultants-linear-gradient-type1">3ème étape<br>la confirmation</span>
                    <span class="consultants-linear-gradient-type2">Validez cet engagement en prenant en compte sa valeur</span>
                </div>
            </div>
        </div>
    </main>
</div>
<?php require_once __DIR__. "/../src/inc/footer.php"; ?>