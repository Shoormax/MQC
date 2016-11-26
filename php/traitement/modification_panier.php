<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 02:12
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/TypeMouvement.php';
include_once '../classes/StockMouvement.php';
include_once '../classes/Produit.php';
include_once '../classes/Panier.php';

$tabRetour['html'] = 'Impossible d\'afficher cette page';

$panier = Panier::rechercheParId($_POST['id_panier']);
$produit = Produit::rechercheParId($_POST['id_produit']);
if($panier instanceof Panier) {
    $user = Utilisateur::rechercheParId($panier->getIdUtilisateur());
    if(isset($_POST['method'])) {
        if($_POST['method'] == 'suppression'){
            $panier->suppressionProduit($_POST['id_produit'], $panier->getQuantiteProduit($produit->getId()) == 1 ? null : 1);
            $tabRetour['html'] = 'Suppression effectuée avec succès.';
        }
        else{
            $panier->ajoutProduit($_POST['id_produit'], 1);
            $tabRetour['html'] = 'Ajout effectué avec succès.';
        }
        $tabRetour['id_utilisateur'] = $panier->getIdUtilisateur();
    }
}

echo  json_encode($tabRetour);