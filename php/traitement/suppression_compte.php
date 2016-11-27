<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 18:43
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
$tabRetour['html'] = 'Impossible d\'effectuer cette action.';
if($user instanceof Utilisateur) {
    $tabRetour['html'] = 'Mot de passe incorrect.';
    if(isset($_POST['password']) && !empty($_POST['password']) && $_POST['password'] == $user->getPassword()) {
        $user->delete();
        $tabRetour['html'] = 'Compte supprimé.';
    }
}

echo json_encode($tabRetour);