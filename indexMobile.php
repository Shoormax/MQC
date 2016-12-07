<?php
/**
 * Created by PhpStorm.
 * User: ValentinLeGentil
 * Date: 20/09/2016
 * Time: 17:08
 */
/**
 * Accueil du site
 */
include_once 'php/path.php';
include_once 'php/include/header.php';
include_once 'php/include/init.php';

if(isset($_GET['language'])) {
    $id_langue = $_GET['language'] == '1' ?  2 : 1;
}
else {
    $id_langue = 1;
}

$param = array('id_langue' => $id_langue);

//@todo gérer la langue avec des cookies
$articles = Article::rechercherParParam($param, 6);
?>
    <script src="https://use.fontawesome.com/992faf6002.js"></script>
    <link rel="icon" type="image/png" href="img/min/Musee.png" />
    <body>
    <div id="menu_haut">
        <div id="link_container" class="nav_item">
            <img src="img/svg/LogoAccueil.svg">
        </div>

        <?php
        foreach ($articles as $a) {
            echo '<div id="link_'.$a->getTitreNavbar().'" class="nav_item">
                      <img src="img/svg/Logo'.$a->getImageNavbar().'.svg">
                  </div>';
        }
        ?>
        <div id="link_Contact" class="nav_item">
            <img src="img/svg/LogoContact.svg">
        </div>
    </div>

    <div id="container">
        <div id="panorama" >
            <img src="img/banniere_V2.png">
        </div>
        <?php
        foreach ($articles as $a) {
            include 'php/views/main_page/article.php';
        }
        include 'php/views/main_page/contact.php';
        ?>

        <a id="mentions_legales" href="php/views/main_page/mentions_legales.php">Mentions légales</a>
    </div>
    </body>

<?php
include_once('php/include/footer.php');
