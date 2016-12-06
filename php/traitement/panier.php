<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 00:20
 */
/**
 * Page appelée pour l'affichage du panier.
 * @require id_produit
 * @require id_utilisateur
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/Produit.php';
include_once '../classes/Panier.php';

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);

$tabRetour = array();
$tabRetour['html'] = 'Erreur lors de l\'affichage de la page.';

if($user instanceof Utilisateur) {
    $panier = $user->getPanierNonValide();
    $tabRetour['html'] = '<div class="tableauPanier" id="tablePanier">';
    if($panier instanceof Panier && !empty($panier->getProduits())) {
        foreach ($panier->getProduits() as $p) {
            $produit = Produit::rechercheParId($p['id_produit']);
            $tabRetour['html'] .= '<div class="blocPanier">
                                        <img class="imagePanier" src="'.$produit->getImage().'"><div>'.ucfirst($produit->getLibelle()).'</div>'.$panier->getQuantiteProduit($p['id_produit']).'
                                        <div>'.$produit->getPrix()*$panier->getQuantiteProduit($p['id_produit']).' €</div>
                                        <i class="fa fa-minus-circle" aria-hidden="true" onclick="modificationPanier('.$p['id_produit'].','.$panier->getId().', this)"></i>
                                        <i class="fa fa-plus-circle" aria-hidden="true" onclick="modificationPanier('.$p['id_produit'].','.$panier->getId().', this)"></i>
                                    </div>';
        }
        $tabRetour['html'] .= '<div class="total"><span>Total : '.$panier->getTotal().' €</span></div>';
        $tabRetour['html'] .= '<div><input class="button" type="button" id="validationPanier'.$panier->getId().'" onclick="validationPanier('.$panier->getId().', '.$_POST['id_utilisateur'].')" value="Valider">';
        $tabRetour['html'] .= '<i class="fa fa-spinner hide" aria-hidden="true" id="validationPanierLoader'.$panier->getId().'"></i></div>';

    }
    else{
        $tabRetour['html'] = '<a onclick="affichagePanier()">Ce panier est vide.</a>';
    }

}

echo json_encode($tabRetour);