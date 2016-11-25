<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:10
 */
include_once('../../path.php');
include_once ('../../include/init.php');
include_once ('../../classes/Auth.php');
include_once ('../../classes/CommunTable.php');
include_once ('../../classes/Utilisateur.php');
include_once ('../../classes/Produit.php');
include_once ('../../classes/Boutique.php');

$produit = Produit::rechercheParId($_POST['id_produit']);
$boutique = Boutique::rechercheParId($produit->getIdBoutique());

$tabRetour = array();
$tabRetour['html'] = 'Erreur lors de l\'affichage de la page';

if($produit instanceof Produit) {
    $tabRetour['html'] = 'ID : '.$produit->getId().'<br>'.(string)$produit.'<br>
                '.$produit->getPrix().'<br><img src="'.$produit->getImage().'" alt=""photoarticlemdeir style="width:300px"/><br>
                '.(string)$boutique.'<br>
                '. $boutique->getAdresseComplete('<br>').
                '<br><br>';
}

echo json_encode($tabRetour);

