<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 02:11
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Boutique.php';
include_once '../classes/Produit.php';

//libelle prix stock id_boutique
$tabRetour = array();
$boutique = Boutique::rechercheParId($_POST['id_boutique']);
$tabRetour['html'] = 'Impossible de créer ce produit.';
$tabRetour['status'] = '000012';
if($boutique instanceof Boutique) {
    $p = new Produit();
    $produit = $p->add($_POST['libelle'], $_POST['prix'], $_POST['stock'], $_POST['id_boutique'], '', $_POST['description']);
    $tabRetour['html'] = 'Ajout effectué avec succès.';
    $tabRetour['status'] = 1;
}

echo json_encode($tabRetour);