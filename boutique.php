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
  <link rel="stylesheet" href="css/boutique.css">
</head>
<body>

<div id="formulaireConnexion" class="blurFullScreen">
  <div class="content">
    <?php include("php/views/connexion.php"); ?>
  </div>
</div>

<header>
  <div class="extremite">Logo</div>
  <div><input type="text" placeholder="Rechercher"></div>
  <div class="compte extremite">
    <?php include('php/views/navbar_compte.php'); ?>
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
        include 'php/views/affichage_produits.php';
      }
    echo '<div id="detailProduit" class="hide"></div>';
    ?>
  </div>
</div>
<script src="js/boutique.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
