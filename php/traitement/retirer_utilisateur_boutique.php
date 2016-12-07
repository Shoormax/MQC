<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 07/12/2016
 * Time: 22:53
 */
include_once '../path.php';
include_once '../include/init.php';

$boutique = Boutique::rechercheParId($_POST['id_boutique']);

$tabRetour['html'] = 'Impossible d\'afficher cette page.';
$tabRetour['status'] = '000029';
if($boutique instanceof Boutique) {
    $tabRetour['html'] = 'Veuillez sélectionner un utilisateur valide.';
    $tabRetour['status'] = '000030';
    $user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
    if($user instanceof Utilisateur) {
        $boutique->supprimerUtilisateur($user->getId());
        $tabRetour['html'] = 'Suppression de l\'utilisateur à la boutique effectué avec succès.';
        $tabRetour['status'] = 1;
    }
}

echo json_encode($tabRetour);