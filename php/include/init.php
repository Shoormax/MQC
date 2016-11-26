<?php

session_start();
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:00
 */
if(__LOCAL_PATH__ !== "http://monquartierconfluence.labo-g4.fr/MonQuartierConfluence") {
    ini_set('display_errors', 1);
}

if (strpos($_SERVER["SCRIPT_NAME"], "administration.php") || strpos($_SERVER["SCRIPT_NAME"], "gestion/index.php")) {
    define("__ADDRESS_CLASSES__",  "../php/classes/");
}
else if(strpos($_SERVER["SCRIPT_NAME"], "connexion.php")) {
    define("__ADDRESS_CLASSES__",  "../classes/");
}
else if(strpos($_SERVER["SCRIPT_NAME"], "autocomplementationProduit.php")) {
    define("__ADDRESS_CLASSES__",  "classes/");
}

if(file_exists(__ADDRESS_CLASSES__.'Configuration.php')) {
    include_once __ADDRESS_CLASSES__.'Configuration.php';
    Configuration::chargementClasses();
}
$user = null;
try {
    $pdo = new PDO('mysql:host='.__DB_HOST__.';dbname='.__DB_NAME__, __USER__, __PASSWORD__, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage()."<br>";
    die;
}


