<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 20:59
 */

require 'classes/Produit.php';

$p = new Produit();
$produit = $p->add(1, 'KPMZ HDIU HZ', '25.53');
var_dump($produit->getId());
var_dump(Produit::rechercheProduitParId($produit->getId()));