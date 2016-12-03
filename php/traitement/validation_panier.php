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
include_once '../classes/Produit.php';
include_once '../classes/Panier.php';
include_once '../classes/Mail.php';

$tabRetour['html'] = 'Impossible d\'afficher cette page';
$tabRetour['status'] = '000006';
$panier = Panier::rechercheParId($_POST['id_panier']);

if($panier instanceof Panier && !empty($panier->getProduits())) {
    $user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
    $panier->setValidation(1);
    $panier->update();

    $passage_ligne = "\r\n";
    $boundary = "-----=".md5(rand());
    $header = "From: monquartierconfluence@noreply.fr".$passage_ligne;
    $header .= "MIME-Version: 1.0".$passage_ligne;
    $header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

    $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $ajd = $ajd->format("d-m-Y");
    $subject = 'Récapitulatif de votre panier validé en date du '.$ajd;
    $message = '<div class="recapPanier"><table><tr><td>Libelle</td><td>Prix unitaire</td><td>Quantité</td><td>Prix total</td></tr></table>';
    foreach ($panier->getProduits() as $p) {
        $produit = Produit::rechercheParId($p['id_produit']);
        $message .= '<table><tr><td>'.$produit->getLibelle().'</td><td>'.$produit->getPrix().'</td><td>'.$panier->getQuantiteProduit($produit->getId()).'</td><td>'.($panier->getQuantiteProduit($produit->getId()) * $produit->getPrix()).'</td></tr></table>';
    }
    $message .= '</div>';


    $mail = new Mail($user->getEmail(), $subject, $message, $header);

    $tabRetour['html'] = 'Panier validé avec succès.<br />
                            <a class="facture" href="php/traitement/facturation.php?id='. $_POST['id_panier'] . '" target="_blank">Voir ma facture PDF</a>';
    $tabRetour['status'] = 1;
    $tabRetour['id_utilisateur'] = $panier->getIdUtilisateur();
}

echo json_encode($tabRetour);