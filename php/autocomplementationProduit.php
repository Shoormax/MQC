<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 24/11/2016
 * Time: 01:25
 */
include_once('path.php');
require_once 'include/init.php';
$produits = array();

$texte = $_POST['recherche'];

$produits = Produit::autocomplementationProduit($texte);

echo json_encode($produits);