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
    $tabRetour['html'] = '<div>'.(string)$produit.'</div>
                <div>'.$produit->getPrix().' €<br><img src="'.$produit->getImage().'" alt="imgeArticle" style="width:300px"/></div>
                <div>'.(string)$boutique.'</div>
                <div>'.$produit->getDescription().'</div>
                <div>'. $boutique->getAdresseComplete('<br>').
                '</div>';
}

echo json_encode($tabRetour);

