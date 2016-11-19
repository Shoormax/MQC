<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:00
 */
if(__LOCAL_PATH__ == "http://monquartierconfluence.labo-g4.fr/MonQuartierConfluence") {
    ini_set('display_errors', 1);
}

include_once __ADDRESS_CLASSES__.'Configuration.php';


try {
    $pdo = new PDO('mysql:host='.__DB_HOST__.';dbname='.__DB_NAME__, __USER__, __PASSWORD__, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage()."<br>";
    die;
}

Configuration::chargementClasses();
