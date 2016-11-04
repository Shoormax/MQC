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
    'responsive'
]; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mon Quartier Confluence</title>
  <?php
  foreach ($aCss as $sNomFicher) {
    echo '<link rel="stylesheet" href="'.__CSS_PATH__.$sNomFicher.'.css" type="text/css">';
  }
  ?>
  <link href="https://fonts.googleapis.com/css?family=Roboto|Proza+Libre" rel="stylesheet">
</head>
