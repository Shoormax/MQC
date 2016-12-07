<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 05/12/2016
 * Time: 17:48
 */

include_once '../path.php';
include_once '../include/init.php';

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);

$tabRetour = array();
$tabRetour['html'] = 'Impossible d\'effectuer cette action.';
$tabRetour['status'] = '000024';
if($user instanceof Utilisateur) {
    $tabRetour['html'] = 'Boutique ajoutée avec succès.';
    $tabRetour['status'] = 1;

    $adresse = '';
    $code_postal = '';
    $ville = '';

    if(isset($_POST['libelle']) && !empty($_POST['libelle'])) {
        $libelle = $_POST['libelle'];
    }
    else {
        $tabRetour['html'] = 'Le libelle ne peut être vide.';
        $tabRetour['status'] = '000025';
    }

    if(isset($_POST['adresse'])) {
        $adresse = $_POST['adresse'];
    }

    if(isset($_POST['code_postal'])) {
        $code_postal = $_POST['code_postal'];
    }

    if(isset($_POST['ville'])) {
        $ville = $_POST['ville'];
    }

    if($tabRetour['status'] == 1) {
        $boutique = new Boutique();
        $boutique->add($libelle, $adresse, $code_postal, $ville);
    }
}

echo json_encode($tabRetour);
