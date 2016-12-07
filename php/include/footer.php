<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 20/09/2016
 * Time: 17:27
 */
/**
 * Dans ce fichier, on inclut les javascript qui
 * sont chargés après avoir chargé l'affichage de la page
 * Cela permet à l'utilisateur de voir le site pendant le chargement
 * des fichiers JS
 */

$aCss = [
    'index',
    'scroll',
    'event',
    'deploiement',
    'panorama',
    'map'
];

echo'<footer>';
    foreach ($aCss as $sNomFicher) {
      echo' <script type="text/javascript" src="'.__JS_PATH__.$sNomFicher.'.js"></script>';
    }
echo'<script async defer type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBz_GvUUBtEyXLNt9kLekQ6pYc7LQJMAWc&callback=initMap"></script>';
    echo '<script src="js/cookiechoices.js"></script>';
    echo '</footer>
</HTML>';
