<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 05/12/2016
 * Time: 18:17
 */

include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/Boutique.php';

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);

$tabRetour = array();
$tabRetour['html'] = 'Impossible d\'effectuer cette action.';
$tabRetour['status'] = '000021';
if($user instanceof Utilisateur && $user->isAdmin()) {
    $tabRetour['html'] = 'Impossible de trouver cette boutique, veuillez réessayer.';
    $tabRetour['status'] = '000022';
    $boutique = Boutique::rechercheParId($_POST['id_boutique']);
    if($boutique instanceof Boutique) {
        $tabRetour['html'] = 'Modification effectuée avec succès.';
        $tabRetour['status'] = 1;

        if(isset($_POST['libelle']) && !empty($_POST['libelle'])) {
            $boutique->setLibelle($_POST['libelle']);
        }
        else {
            $tabRetour['html'] = 'Le libelle ne peut être vide.';
            $tabRetour['status'] = '000023';
        }

        if(isset($_POST['adresse'])) {
            $boutique->setAdresse($_POST['adresse']);
        }

        if(isset($_POST['code_postal'])) {
            $boutique->setCodePostal($_POST['code_postal']);
        }

        if(isset($_POST['ville'])) {
            $boutique->setVille($_POST['ville']);
        }

        if($tabRetour['status'] == 1) {
            $boutique->update();
        }
    }
}

echo json_encode($tabRetour);