<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 20:59
 */
$id_user = 1;

//Ajout
//$p = new Panier();
//$panier = $p->add($id_user);
//$pro = new Produit();
//$produit = $pro->add('ProduiApo', 18.08, 10, 1);
//$panier->ajoutProduit($produit->getId(), 2);

//Modif
//$p = Panier::rechercheParId(1);
//$p->ajoutProduit(2,4);

//Suppr
//$p = Panier::rechercheParId(1);
//$p->suppressionProduit(2);

//$a = new Article();
//$a->add('Les commerces', 'Commerces et activités', "Confluence c'est la vie refré @ € ô'ï é è", 't', 1, 'img/min/musee.jpg');

//$panier = Panier::rechercheParId(2);
//$panier->setTotal(18.07);
//$panier->update();

$u = Utilisateur::rechercheParId(1);
var_dump($u->getPaniersUtilisateur());