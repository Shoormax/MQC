<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 05/12/2016
 * Time: 18:19
 */

include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/Boutique.php';
include_once '../classes/Produit.php';

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);

$tabRetour = array();
$tabRetour['html'] = 'Impossible d\'effectuer cette action.';
$tabRetour['status'] = '000018';
if($user instanceof Utilisateur) {
    $tabRetour['html'] = '';
    $tabRetour['status'] = '000019';
    $boutique = Boutique::rechercheParId($_POST['id_boutique']);
    if($boutique instanceof Boutique) {
        $tabRetour['html'] = 'Suppression impossible : cette boutique est liée à des produits actifs.';
        $tabRetour['status'] = '000020';
        if(!$boutique->hasProduct()) {
            $boutique->delete();
            $tabRetour['html'] = 'Suppression effectuée avec succès.';
            $tabRetour['status'] = 1;
        }
    }
}

echo json_encode($tabRetour);