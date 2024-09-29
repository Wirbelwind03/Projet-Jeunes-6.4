<?php
    if (session_status() === 1) {
        session_start();
    }

    // Change la couleur d'un button
    function setNavBarActive($pageName) {
        // Récupère le nom de la page et ajoute la classe "active"
        echo (basename($_SERVER['PHP_SELF']) === $pageName) ? 'active' : '';
    }

    // Change la couleur du button dans la barre navigateur selon le type d'utilisateur connectée
    // userType : Type d'utilisateur ( Jeune, Référent, Consultant )
    function setUserTypeNavBarActive($userType) {
        // Les pages qui ne sont pas affectées par le changement
        $pages = array("home.php", "partners.php");
        // Renvoie "active" si le nom de la page actuelle n'est pas une exception ET si l'utilisateur est connectée
        echo (!in_array(basename($_SERVER['PHP_SELF']), $pages) && isset($_SESSION['type']) && $_SESSION["type"] === $userType) ? 'active' : '';
    }

    // Cache les buttons dans la barre navigateur selon le type d'utilisateur
    // ( Ex : Si un Jeune est connectée, il ne peut pas voir Consultant et Référent )
    // userType : Type d'utilisateur ( Jeune, Référent, Consultant )
    function hideUserTypeNavBarActive($userType) {
        // Renvoie la classe "hide" si l'utilisateur connectée n'est pas égale celle du button dans la barre navigateur
        echo (isset($_SESSION['type']) && $_SESSION["type"] !== $userType) ? 'hide' : '';
    }
    
    // Renvoie une chaine de caractère de l'utilisateur connecté
    function getUserType(){
        if (isset($_SESSION['type'])){
            // Traduit le mot de anglais en français
            switch($_SESSION["type"]){
                case "juniors":
                    echo "Jeune";
                    break;
                case "referents":
                    echo "Référent";
                    break;
                case "consultants":
                    echo "Consultants";
                    break;
                default:
                    break;
            }
        }

    }

    // Récupère la photo de profile de l'utilisateur
    function getUserProfilPicture(){
        $profilPicturePath = "database/" . $_SESSION["type"] . "/" . $_SESSION["user"]["mail"] . "/profil-picture.png";
        if (file_exists(__DIR__ . "/../" . $profilPicturePath)){
            echo "/../src/" . $profilPicturePath;
        }
        else{
            echo "assets/images/profil-picture.png";
        }   
    }
?>
<!-- Barre navigateur en haut de la page -->
<header class="navbar-wrapper">

    <nav class="navbar">

        <!-- Coté gauche de la barre navigateur -->
        <ul class="menu">

            <!-- Button dans la barre navigateur pour ACCUEIL -->
            <li id="navbar-home" class="item <?php setNavBarActive("home.php") ?>"><a href="home.php">ACCUEIL</a></li>

        </ul>

        <!-- Milieu de la barre navigateur -->
        <ul class="menu">
            
            <!-- Button dans la barre navigateur pour JEUNE -->
            <li id="navbar-junior" class="item <?php 
                setNavBarActive("junior-login.php"); 
                setUserTypeNavBarActive("juniors");
                hideUserTypeNavBarActive("juniors");
                ?>" >
                <a href="junior-login.php">JEUNE</a>
            </li>
            
            <!-- Button dans la barre navigateur pour REFERENT -->
            <li id="navbar-referent" class="item <?php 
                setNavBarActive("referent-login.php"); 
                setUserTypeNavBarActive("referents");
                hideUserTypeNavBarActive("referents");
                ?>">
                <a href="referent-login.php">RÉFÉRENT</a>
            </li>
            
            <!-- Button dans la barre navigateur pour CONSULTANT -->
            <li id="navbar-consultant" class="item <?php 
                setNavBarActive("consultant-login.php"); 
                setUserTypeNavBarActive("consultants");
                hideUserTypeNavBarActive("consultants");
                ?>">
                <a href="consultant-login.php">CONSULTANT</a>
            </li>
            
            <!-- Button dans la barre navigateur pour PARTENAIRES -->
            <li id="navbar-partners" class="item <?php setNavBarActive("partners.php") ?>"><a href="partners.php">PARTENAIRES</a></li>
        
        </ul>

        <!-- Coté droit de la barre navigateur -->
        <ul class="menu">

            <li class="item has-dropdown has-image">
                <button id="light-dark-mode-button"><img src=<?php getLightModeImage("assets/images/light") ?> width="32px" height="32px"></button>
            </li>

            <!-- Photo de profil pour le menu déroulant -->
            <li class="item has-dropdown has-image">
                <a>
                    <!-- Afficher le photo de profil de l'utilisateur -->
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                        <p><img src="<?php getUserProfilPicture() ?>" class="profil-picture logged-in" width="32px" height="32px"></p>
                    
                    <!-- Afficher l'icone d'un visiteur -->
                    <?php else : ?>
                        <p><img src=<?php getLightModeImage("assets/images/user") ?> class="profil-picture" width="32px" height="32px"></p>
                    <?php endif; ?>
                    
                    <!-- Texte en dessous de la photo de profil -->
                    <p>Profil</p>
                </a>
                
                <!-- Menu déroulant de l'utilsateur -->
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                    <ul class="dropdown logged-in">
                <?php else : ?>
                    <ul class="dropdown">
                <?php endif; ?>
                    <!-- Si l'utilisateur est connecté -->
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                        
                        <!-- Haut de menu déroulant -->
                        <div class="dropdown-item">
                            
                            <!-- Affiche le type d'utilisateur -->
                            <li><span ><?php getUserType(); ?></span></li>

                            <!-- Affiche le nom et prénom de l'utilisateur connecté -->
                            <li><span>Connecté en tant que</span></li>
                            <li><span class="username user-color"><?php echo $_SESSION['user']['name'] ?> <?php echo $_SESSION['user']['firstname'] ?></span></li>
                        
                        </div>
                        
                        <!-- Milieu du menu déroulant -->
                        <div class="dropdown-item">
                            <li><a href="profil.php">Mon profil</a></li>
                            <li><a href="referrals.php">Mes références</a></li>
                            <li><a href="settings.php">Options</a></li>
                        </div>

                        <!-- Bas du menu déroulant -->
                        <div class="dropdown-item">
                            <li><a href="/../src/libs/logout.php">Se déconnecter</a></li>
                        </div>

                    <!-- Si l'utilisateur est un visiteur -->
                    <?php else : ?>
                        
                        <div class="dropdown-item">
                            <li><span>Visiteur</span></li>
                        </div>
                        
                        <div class="dropdown-item">
                            <li><a href="junior-login.php">Se connecter</a></li>
                        </div>
                        
                        <div class="dropdown-item">
                            <li><a href="registration.php">S'inscrire</a></li>
                        </div>
                    
                    <?php endif; ?>
                </ul>

            </li>
        </ul>
    </nav>
</header>