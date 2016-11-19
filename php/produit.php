<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 20:59
 */
include_once('php/classes/Panier.php');
include_once('php/classes/Produit.php');

$id_user = 2;

//Ajout
//$p = new Panier();
//$panier = $p->add($id_user);
//$pro = new Produit();
//$produit = $pro->add($id_user, 'ProduiApo', 18.08, 10);
//$panier->ajoutProduit($produit->getId(), 2);

//Modif
var_dump($p = Panier::rechercheParId(1));
//$p->ajoutProduit(3,4);

//Suppr
//$p = Panier::rechercheParId(1);
//$p->suppressionProduit(2);