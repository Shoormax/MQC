<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 07/12/2016
 * Time: 22:22
 */
include_once '../path.php';
include_once '../include/init.php';

$boutique = Boutique::rechercheParId($_POST['id_boutique']);

$tabRetour['html'] = 'Impossible d\'afficher cette page.';
$tabRetour['status'] = '000027';
if($boutique instanceof Boutique) {
    $tabRetour['html'] = 'Veuillez sélectionner un utilisateur valide.';
    $tabRetour['status'] = '000028';
    $user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
    if($user instanceof Utilisateur) {
        $boutique->addUtilisateur($user->getId());
        $tabRetour['html'] = 'Ajout de l\'utilisateur à la boutique effectué avec succès.';
        $tabRetour['status'] = 1;
    }
}

echo json_encode($tabRetour);