<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 01:09
 */
include_once '../path.php';
include_once '../include/init.php';

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
            $tabRetour['html'] = 'Le libelle ne peut être vide.';
            $tabRetour['status'] = '000015';
            if(isset($_POST['libelleProduit']) && !empty($_POST['libelleProduit'])) {
                $tabRetour['html'] = 'Le prix doit être renseigné.';
                $tabRetour['status'] = '000015';
                if (isset($_POST['prixProduit']) && !empty($_POST['prixProduit'])) {
                    $tabRetour['status'] = 1;
                    $tabRetour['html'] = 'Modifications effectuées avec succès.';
                    $produit->setLibelle($_POST['libelleProduit']);
                    $produit->setPrix($_POST['prixProduit']);
                    $produit->setStock($_POST['stock']);
                    $produit->setDescription($_POST['description']);
                    $produit->update();
                }
            }
        }
    }
}
echo json_encode($tabRetour);