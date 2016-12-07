<?php

session_start();
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:00
 */
if(!isset($_COOKIE["langue"]) || empty($_COOKIE["langue"])) {
  setcookie("langue", 1, time()+80000);
}


if(__LOCAL_PATH__ !== "http://monquartierconfluence.labo-g4.fr/MonQuartierConfluence") {
    ini_set('display_errors', 1);
}

$prefixe = '';

while (!file_exists($prefixe.__ADDRESS_CLASSES__.'Configuration.php')) {
    $prefixe .= '../';
}

define('__ADDRESS_CLASSES__', $prefixe.'php/classes/');

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
