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
include_once('php/path.php');
require_once (__INCLUDE_PATH__.'header.php');

require_once 'php/include/init.php';

//@todo gérer la langue avec des cookies
$id_langue = 1;
$articles = Article::rechercherParParam(array('id_langue' => $id_langue), 6);
?>
    <link rel="icon" type="image/png" href="img/min/Musee.png" />
    <body>
    <div id="btnConnexion"><a href="boutique.php">Boutique</a></div>
    <div id="menu_haut">
        <?php
        foreach ($articles as $a) {
            echo '<div id="link_'.$a->getTitreNavbar().'" class="nav_item">
                  <img src="img/svg/Logo'.$a->getImageNavbar().'.svg">
                  <span class="nav_txt">'.$a->getTitreNavbar().'</span>
                  </div>';
        }
        ?>
    </div>

    <div id="container">
        <div id="panorama" >
            <img src="img/AccueilConfluence25.png">
        </div>
        <?php
        foreach ($articles as $a) {
            include 'php/article.php';
        }
        include 'php/contact.php';
        ?>

        <a id="mentions_legales" href="php/mentions_legales.php">Mentions légales</a>
    </div>
    </body>

<?php
include_once(__INCLUDE_PATH__.'footer.php');
