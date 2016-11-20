<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:59
 */
/**
 * Gestion des articles côté admin.
 *
 */
function redir($url)
{
    echo "<script language=\"javascript\">";
    echo "window.location='$url';";
    echo "</script>";
}

if(!isset($_GET['co'])) {
    redir('index.php');
}


include_once('../php/path.php');
require_once (__INCLUDE_PATH__.'header.php');
require_once '../php/include/init.php';
echo '<link rel="stylesheet" href="../css/admin.css" type="text/css">';
//@todo gérer la langue avec des cookies
$id_langue = 1;
$param = array('id_langue' => $id_langue);
$limit = 1;
$articles = Article::rechercherParParam($param, $limit);
?>
    <link rel="icon" type="image/png" href="../img/min/Musee.png" />
    <body>
    <div id="btnConnexion"><a href="boutique.php">Boutique</a></div>
    <div id="menu_haut">
        <?php
        foreach ($articles as $a) {
            echo '<div id="link_'.$a->getTitreNavbar().'" class="nav_item">
                  <img name="HUE" src="../img/svg/Logo'.$a->getImageNavbar().'.svg">
                  <span class="nav_txt">'.$a->getTitreNavbar().'</span>
                  </div>';
        }
        ?>
    </div>
    <form action='php/modificationArticles.php?<?php foreach ($param as $key => $val){echo $key.'='.$val.'&';} echo 'limit='.$limit; ?>' method='post'  enctype="multipart/form-data">
    <div id="container">
        <div id="panorama" >
            <img name="img" src="../img/AccueilConfluence25.png">
        </div>
        <?php
        $prefixe = '../';
        foreach ($articles as $a) {
            include 'php/article.php';
        }
        ?>
    </div>
    <input type='submit' class='button' style='border:2px solid' value='Enregistrer'>
    </form>
    </body>

<?php
include_once(__INCLUDE_PATH__.'footer.php');

