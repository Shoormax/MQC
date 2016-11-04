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
include_once('../path.php');
echo'
    <footer>
        <script type="text/javascript" src="'.__JS_PATH__.'index.js"></script>
        <script type="text/javascript" src="'.__JS_PATH__.'scroll.js"></script>
        <script type="text/javascript" src="'.__JS_PATH__.'event.js"></script>
        <script type="text/javascript" src="'.__JS_PATH__.'deploiement.js"></script>
        <script type="text/javascript" src="'.__JS_PATH__.'panorama.js"></script>
    </footer>
</HTML>';
