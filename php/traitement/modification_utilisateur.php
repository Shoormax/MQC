<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 17:07
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
//id_utilisateur:id_utilisateur, nom:nom, prenom:prenom, email:email, new_password:new_password, password:password

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);

$tabRetour = array();
$tabRetour['html'] = 'Impossible d\'effecture cette action.';
if($user instanceof Utilisateur) {
    $tabRetour['html'] = 'Le mot de passe entré n\'est pas valide.';

    if(isset($_POST['password']) && !empty($_POST['password']) && $_POST['password'] == $user->getPassword()) {
        if(isset($_POST['new_password']) && !empty($_POST['new_password'])) {
            $user->setPassword($_POST['new_password']);
        }
        if(isset($_POST['nom']) && !empty($_POST['nom'])) {
            $user->setNom($_POST['nom']);
        }
        if(isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            $user->setPrenom($_POST['prenom']);
        }
        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $user->setEmail($_POST['email']);
        }
        $user->update();
        $tabRetour['html'] = 'Modifications apportées avec succès.';
    }
}

echo json_encode($tabRetour);