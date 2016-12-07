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
        $tabRetour['html'] = '<div class="recap_commandes"><span></span><span>Libelle</span><span>Quantite</span><span>Prix total</span></div><div class="traitBlancPetit"></div>';
        foreach ($produits as $p) {
            $produit = Produit::rechercheParId($p['id_produit']);
            $tabRetour['html'] .= '<div class="recap_commandes"><span></span><span>'.$produit->getLibelle().'</span><span>'.$panier->getQuantiteProduit($p['id_produit']).'</span><span>'.($panier->getQuantiteProduit($p['id_produit'])*$produit->getPrix()).'</span></div><div class="traitBlancPetit"></div>';
        }
    }
}

echo json_encode($tabRetour);