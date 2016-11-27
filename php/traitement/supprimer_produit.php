<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 01:15
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Panier.php';
include_once '../classes/Produit.php';

$produit = Produit::rechercheParId($_POST['id_produit']);
$produits = array();
$tabRetour = array();
$tabRetour['status'] = '000009';
$tabRetour['html'] = 'Impossible d\'effectuer cette action.';
if($produit instanceof Produit) {
    $paniers = Panier::rechercherParParam(array('validation' => 0));
    $tabRetour['status'] = '000010';
    $tabRetour['html'] = 'Impossible de supprimer ce produit.';
    if($produit instanceof Produit) {
        if($produit->isUtilise()) {
            $tabRetour['status'] = '000011';
            $tabRetour['html'] = 'Impossible de supprimer ce produit car il est actuellement dans un panier non validé.';
        }
        else {
            $tabRetour['status'] = 1;
            $tabRetour['html'] = '';
            $produit->delete();
        }
    }
}

echo json_encode($tabRetour);