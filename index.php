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
require_once 'php/classes/CommunTable.php';
require_once 'php/classes/Article.php';
$aPages = [
  'Accueil'       => 'accueil.php',
  'Musée'         => 'musee.php',
  'Architecture'  => 'architecture.php',
  'Commerces'     => 'commerces.php',
  'Accessibilité' => 'accessibilite.php',
  'Prochainement' => 'prochainement.php',
  'Contact'       => 'contact.php',
  'Produit'       => 'produit.php'
];
?>
  <link rel="icon" type="image/png" href="img/min/Musee.png" />
  <body>
  <div id="btnConnexion"><a href="php/admin.php">Connexion</a></div>
  <div id="menu_haut">
    <?php
    foreach ($aPages as $titre => $page) {
      $sSsAccent = ucfirst(str_replace('.php', '', $page));
      echo '<div id="link_'.$sSsAccent.'" class="nav_item">
              <img src="img/svg/Logo'.$sSsAccent.'.svg">
              <span class="nav_txt">'.$titre.'</span>
            </div>';
    }
    ?>
  </div>

  <div id="container">
    <?php
    foreach ($aPages as $titre => $page) {
      $sSsAccent = ucfirst(str_replace('.php', '', $page));
      echo $page == "accueil.php" ? '<div id="'.$sSsAccent.'" class="">' : '<div id="'.$sSsAccent.'" class="sous-container">';
      include 'php/'.$page;
      echo '</div>';
    }
    ?>
    <a id="mentions_legales" href="php/mentions_legales.php">Mentions légales</a>
  </div>
  </body>

<?php
include_once(__INCLUDE_PATH__.'footer.php');
