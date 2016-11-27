<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 21:32
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Produit.php';
include_once '../classes/Panier.php';
include_once '../classes/Utilisateur.php';

$panier = Panier::rechercheParId($_POST['id_panier']);

$tabRetour = array();
$tabRetour['html'] = 'Impossible d\'accéder à cette page.';

if($panier instanceof Panier) {
    $produits = $panier->getProduits();
    $tabRetour['html'] = 'Cette commande ne contient aucun produit.';
    if(is_array($produits) && !empty($produits)) {
        $tabRetour['html'] = '<table><tr><td>Libelle</td><td>Quantite</td><td>Prix total</td></tr></table>';
        foreach ($produits as $p) {
            $produit = Produit::rechercheParId($p['id_produit']);
            $tabRetour['html'] .= '<table><tr><td>'.$produit->getLibelle().'</td><td>'.$panier->getQuantiteProduit($p['id_produit']).'</td><td>'.($panier->getQuantiteProduit($p['id_produit'])*$produit->getPrix()).'</td></tr>';
        }
    }
}

echo json_encode($tabRetour);