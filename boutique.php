<?php

include_once('php/path.php');
include_once ('php/include/init.php');

if(isset($_POST['connexion'])) {
  include('php/traitement/connexion.php');
}

$produits = Produit::rechercherParParam(array('active' => 1), 10);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boutique - Mon Quartier Confluence</title>
  <link rel="icon" type="image/png" href="img/min/Musee.png" />
  <link rel="stylesheet" href="css/boutique.css">
</head>
<body>

<div id="formulaireConnexion" class="blurFullScreen">
  <div class="content">
    <?php include("php/views/boutique/connexion.php"); ?>
  </div>
</div>

<header>
  <div class="extremite"><a href="index.php">Logo</a></div>
  <div><input type="text" placeholder="Rechercher un produit..."></div>
  <div class="compte extremite">
    <?php
    if(isset($_SESSION['user'])) {
      echo '<div>Bonjour tu es connecté gg</div>';
      echo '<a href="./deconnexion.php">Déconnexion</a>';
    } else {
      echo '<a href="./connexion.php" id="btnConnexion">Connejxion</a>';
    }
    ?>
  </div>
</header>
<div id="content">
  <nav>
    <?php
    //@todo
    ?>
  </nav>
  <div id="boutique">
    <?php
      foreach ($produits as $produit) {
        include 'php/views/boutique/affichage_produits.php';
      }
    ?>
  </div>
</div>
<script src="js/boutique.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
