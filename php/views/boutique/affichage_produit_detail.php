<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:10
 */
include_once '../../path.php';
include_once '../../include/init.php';

$produit = Produit::rechercheParId($_POST['id_produit']);
$boutique = Boutique::rechercheParId($produit->getIdBoutique());

$tabRetour = array();
$tabRetour['html'] = 'Erreur lors de l\'affichage de la page.';

if($produit instanceof Produit) {
    $tabRetour['html'] = '<div class="contentDetail">
                <img src="'.$produit->getImage().'" alt="imgeArticle" style="width:100%"/>   
                <div class="lesInputs"><div>'.(string)$produit.'</div>
                <div class="prixArticle">'.$produit->getPrix().' €</div></div>
                <div class="separator"></div>
                <div>'.(string)$boutique.'</div>
                <div class="tleft">'.$produit->getDescription().'</div>
                <div>'. $boutique->getAdresseComplete('<br>').
                '</div></div>';
}

echo json_encode($tabRetour);

