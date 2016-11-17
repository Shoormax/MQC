<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 20:59
 */

require_once 'classes/Produit.php';
require_once 'classes/Utilisateur.php';

$a = Article::rechercheParId('Article', 2);
$a->setShortTexte('bonjour');
$a->update();