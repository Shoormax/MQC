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

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);

$tabRetour = array();
$tabRetour['html'] = 'Erreur lors de l\'affichage de la page.';

if($user instanceof Utilisateur) {
    $panier = $user->getPanierNonValide();
    $tabRetour['html'] = '<table id="tablePanier">';
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
        $tabRetour['html'] .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="business" value="monquartierconfluence@gmail.com">
                                    <input type="hidden" name="upload" value="1">
                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input type="hidden" name="hosted_button_id" value="T2A34QTTHRW82">
                                    <input type="hidden" name="item_name" value="Votre panier">
                                    <input type="hidden" name="amount" value="'.$panier->getTotal().'">
                                    <input type="hidden" name="return" value="http://localhost/MQC/boutique.php?id_cart='.$panier->getId().'">
                                    <input type="hidden" name="cancel_return" value="http://localhost/MQC/boutique.php?id_cart=0">
                                    <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/x-click-but01.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne!">
                                </form>';

    }
    else{
        $tabRetour['html'] = '<a onclick="affichagePanier()">Ce panier est vide.</a>';
        $tabRetour['html'] .= '</table>';
    }

}

echo json_encode($tabRetour);