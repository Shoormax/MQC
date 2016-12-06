<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:10
 */
include_once('../../path.php');
include_once ('../../include/init.php');

$produit = Produit::rechercheParId($_POST['id_produit']);
$boutique = Boutique::rechercheParId($produit->getIdBoutique());

$tabRetour = array();
$tabRetour['html'] = 'Erreur lors de l\'affichage de la page.';

if($produit instanceof Produit) {
    $tabRetour['html'] = (string)$produit.'<br>
                '.$produit->getPrix().' €<br><img src="'.$produit->getImage().'" alt="imgeArticle" style="width:300px"/><br>
                '.(string)$boutique.'<br>
                <p>'.$produit->getDescription().'</p>
                '. $boutique->getAdresseComplete('<br>').
                '<br><br>';
}

echo json_encode($tabRetour);

