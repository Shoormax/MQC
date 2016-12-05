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
        $tabRetour['html'] .= 'Créé le : '.$panier->getDateAdd(true);
        $tabRetour['html'] .= '<tr><td>Produit</td><td>Quantite</td><td>Prix unitaire</td><td>Prix total</td><td style="border: none"></td><td style="border: none"><i class="fa fa-times-circle" aria-hidden="true" onclick="affichagePanier()"></i></td></tr>';
        foreach ($panier->getProduits() as $p) {
            $produit = Produit::rechercheParId($p['id_produit']);
            $tabRetour['html'] .= '<tr><td>'.ucfirst($produit->getLibelle()).'</td><td id="quantiteProduitPanier'.$p['id_produit'].'">'.$panier->getQuantiteProduit($p['id_produit']).'</td>
                                    <td>'.$produit->getPrix().' €</td>
                                    <td>'.$produit->getPrix()*$panier->getQuantiteProduit($p['id_produit']).' €</td>
                                    <td><i class="fa fa-minus-circle" aria-hidden="true" onclick="modificationPanier('.$p['id_produit'].','.$panier->getId().', this)"></i></td>
                                    <td><i class="fa fa-plus-circle" aria-hidden="true" onclick="modificationPanier('.$p['id_produit'].','.$panier->getId().', this)"></i></td></tr>';
        }
        $tabRetour['html'] .= '<td style="border: none"></td><td style="border: none"></td><td>Total</td><td>'.$panier->getTotal().' €</td>';
        $tabRetour['html'] .= '</table>';
        $tabRetour['html'] .= '<input class="button" type="button" id="validationPanier'.$panier->getId().'" onclick="validationPanier('.$panier->getId().', '.$_POST['id_utilisateur'].')" value="Valider">';
        $tabRetour['html'] .= '<i class="fa fa-spinner hide" aria-hidden="true" id="validationPanierLoader'.$panier->getId().'"></i>';

    }
    else{
        $tabRetour['html'] = '<a onclick="affichagePanier()">Ce panier est vide.</a>';
        $tabRetour['html'] .= '</table>';
    }

}

echo json_encode($tabRetour);