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
   echo'
 <HTML>
    <head>
        <title>Mon Quartier Confluence</title>
        <link rel="stylesheet" href="'.__CSS_PATH__.'projectone.css" type="text/css">
        <link rel="stylesheet" href="'.__CSS_PATH__.'navbar.css" type="text/css">
        <link rel="stylesheet" href="'.__CSS_PATH__.'cartes.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
		<meta charset="utf-8">
    </head>';