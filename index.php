<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 20/09/2016
 * Time: 17:08
 */
/**
 * Accueil du site
 */
include_once('php/path.php');
require_once (__INCLUDE_PATH__.'header.php');
?>

<body>
    <div id="menu_haut">
        <div id="link_Accueil" class="nav_item">
            <img src="img/min/LogoAccueil.png">
            <span class="nav_txt">Accueil</span>
        </div>
        <div id="link_Musee" class="nav_item">
            <img src="img/min/LogoMuseeTransparent.png">
            <span class="nav_txt">Musée</span>
        </div>
        <div id="link_Quais" class="nav_item">
            <img src="img/min/LogoQuaisTransparent.png">
            <span class="nav_txt">Quais</span>
        </div>
        <div id="link_Commerces" class="nav_item">
            <img src="img/min/LogoCommerceTransparent.png">
            <span class="nav_txt">Commerces</span>
        </div>
        <div id="link_Accessibilite" class="nav_item">
            <img src="img/min/LogoTransportTransparent.png">
            <span class="nav_txt">Accessibilité</span>
        </div>
        <div id="link_Prochainement" class="nav_item">
            <img src="img/min/LogoProchainement.png">
            <span class="nav_txt">Prochainement</span>
        </div>
        <div id="link_Contact" class="nav_item">
            <img src="img/min/LogoContact.png">
            <span class="nav_txt">Contact</span>
        </div>
    </div>

    <div id="container">

        <div id="Accueil" class="sous-container">
            <?php
            include 'php/accueil.php'
            ?>
        </div>
        <div id="Musee" class="sous-container">
            <?php
            include 'php/musee.php'
            ?>
        </div>
        <div id="Quais" class="sous-container">
            <?php
            include 'php/quais.php'
            ?>
        </div>
        <div id="Commerces" class="sous-container">
            <?php
            include 'php/commerces.php'
            ?>
        </div>
        <div id="Accessibilite" class="sous-container">
            <?php
            include 'php/accessibilite.php'
            ?>
        </div>
        <div id="Prochainement" class="sous-container">
            <?php
            include 'php/prochainement.php'
            ?>
        </div>
        <div id="Contact" class="sous-container">
            <?php
                include 'php/contact.php'
            ?>
        </div>
        <a id="mentions_legales" href="php/mentions_legales.php">Mentions légales</a>
    </div>
</body>

<?php
    include_once(__INCLUDE_PATH__.'footer.php');

