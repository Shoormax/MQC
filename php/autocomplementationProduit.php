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
$tabRetour = '';
foreach ($produits as $p) {
    $produit = Produit::rechercheParId($p);
    $tabRetour .= '<tr><td>'.ucfirst($produit->getLibelle()). ' '.round($produit->getPrix(), 2).' € ('.$produit->getStock().')';
}

echo $tabRetour;