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
$aPages = [
'Accueil'       => 'accueil.php',
'Musée'         => 'musee.php',
'Quais'         => 'quais.php',
'Commerces'     => 'commerces.php',
'Accessibilité' => 'accessibilite.php',
'Prochainement' => 'prochainement.php',
'Contact'       => 'contact.php'
];
?>
<body>
  <div id="menu_haut">
    <?php
    foreach ($aPages as $titre => $page) {
      $sSsAccent = ucfirst(str_replace('.php', '', $page));
      echo '<div id="link_'.$sSsAccent.'" class="nav_item">';
        echo '<img src="img/min/Logo'.$sSsAccent.'.png">';
        echo '<span class="nav_txt">'.$titre.'</span>';
      echo '</div>';
    }
    ?>
  </div>

  <div id="container">
    <?php
    foreach ($aPages as $titre => $page) {
      $sSsAccent = ucfirst(str_replace('.php', '', $page));
      echo '<div id="'.$sSsAccent.'" class="sous-container">';
        include 'php/'.$page;
      echo '</div>';
    }
    ?>
    <a id="mentions_legales" href="php/mentions_legales.php">Mentions légales</a>
  </div>
</body>

<?php
include_once(__INCLUDE_PATH__.'footer.php');
