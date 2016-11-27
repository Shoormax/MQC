<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 01:09
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Produit.php';

$produit = Produit::rechercheParId($_POST['id_produit']);
$tabRetour = array();
$produits = array();
$tabRetour['html'] = '000011';
$tabRetour['status'] = 'Impossible de modifier ce produit.';
$image = false;
if($produit instanceof Produit) {
    $produit = Produit::rechercheParId($_POST['id_produit']);
    $paniers = Panier::rechercherParParam(array('validation' => 0));
    $tabRetour['status'] = '000012';
    $tabRetour['html'] = 'Impossible de supprimer ce produit.';
    if ($produit instanceof Produit) {
        if ($produit->isUtilise()) {
            $tabRetour['status'] = '000013';
            $tabRetour['html'] = 'Impossible de mdofier ce produit car il est actuellement dans un panier non validé.';
        }
        else {
            $tabRetour['status'] = 1;
            $tabRetour['html'] = '';
            $produit->setLibelle($_POST['libelleProduit']);
            $produit->setPrix($_POST['prixProduit']);
            $produit->setStock($_POST['stock']);
            $produit->setDescription($_POST['description']);
            $produit->update();
        }
    }
}
echo json_encode($tabRetour);