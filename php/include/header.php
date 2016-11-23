<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 20/09/2016
 * Time: 17:27
 */
/**
 * Ce fichier permet de charger le css au lancement de la page
 * ainsi que l'encodage utf8
 */
header( 'content-type: text/html; charset=utf-8' );
include_once('../path.php');

$aCss = [
    'projectone',
    'navbar',
    'panorama',
    'responsive',
    'print',
    'cartes'
]; ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Elément Google Maps indiquant que la carte doit être affiché en plein écran et
		qu'elle ne peut pas être redimensionnée par l'utilisateur -->
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <title>Mon Quartier Confluence</title>
  <?php
  foreach ($aCss as $sNomFicher) {
    echo '<link rel="stylesheet" href="'.__CSS_PATH__.$sNomFicher.'.css" type="text/css">';
  }
  ?>
  <link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">
</head>
