<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 14:37
 */
/**
 * @require id_panier
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/Panier.php';

$tabRetour['html'] = 'Impossible d\'afficher cette page';
$tabRetour['status'] = '000006';
$panier = Panier::rechercheParId($_POST['id_panier']);

if($panier instanceof Panier && !empty($panier->getProduits())) {
    $panier->setValidation(1);
    $panier->update();
    $tabRetour['html'] = "Panier validé avec succès.<br />
                            <a class=\"facture\" href=\"php/traitement/facturation.php?id=". $_POST['id_panier'] . "\" target=\"_blank\">Voir ma facture PDF</a>";
    $tabRetour['status'] = 1;
    $tabRetour['id_utilisateur'] = $panier->getIdUtilisateur();
}

echo json_encode($tabRetour);