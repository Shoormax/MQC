<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:00
 */

try {
    $pdo = new PDO('mysql:host='.__DB_HOST__.';dbname='.__DB_NAME__, __USER__, __PASSWORD__);
}
catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage()."<br>";
    die;
}
