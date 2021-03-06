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
include_once '../php/path.php';
require_once '../php/include/header.php';
require_once '../php/include/init.php';
echo '<link rel="stylesheet" href="../css/admin.css" type="text/css">';

if(!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$user = Utilisateur::rechercheParId($_SESSION['user']);

if(isset($_GET['language'])) {
    $id_langue = $_GET['language'] == '1' ?  2 : 1;
}
else {
    $id_langue = 1;
}

$param = array('id_langue' => $_COOKIE["langue"]);

$limit = 6;
$articles = Article::rechercherParParam($param, $limit);
?>
    <link rel="icon" type="image/png" href="../img/min/Musee.png" />
    <body>
    <div class="swicthLangue">
      <?php echo Langue::afficherDrapeau($_COOKIE["langue"], 'gestion/administration.php'); ?>
    </div>
    <div id="btnDeconnexion"><a href="../deconnexion.php?retour=index">Déconnexion</a></div>
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
            <img name="img" src="../img/banniere_V2.png">
        </div>
        <?php
        foreach ($articles as $a) {
            include 'php/article.php';
        }
        ?>
    </div>
    <input type='submit' class='button' style='border:2px solid' value='Enregistrer'>
    </form>
    </body>

<?php
include_once '../php/include/footer.php';

