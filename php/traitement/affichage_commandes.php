<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 20:54
 */
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Panier.php';
include_once '../classes/Utilisateur.php';

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
$tabRetour = array();
$tabRetour['html'] = 'Impossible d\'accéder à cette page.';

if($user instanceof Utilisateur) {
    $paniers = Panier::rechercherParParam(array('id_utilisateur' => $_POST['id_utilisateur'], 'validation' => 1));
    $tabRetour['html'] = 'Vous n\'avez aucune commande passée précédement.';
    if(is_array($paniers) && !empty($paniers)) {
        $tabRetour['html'] = '<table><tr><td>Créé le</td><td>Validé le</td><td>Total (€)</td></tr></table>';
        foreach($paniers as $p) {
            $tabRetour['html'] .= '<div class="recap_commandes" onclick="affichage_contenu_commande('.$p->getId().')"><table><tr><td>'.$p->getDateAdd(true).'</td><td>'.$p->getDateUpd(true).'</td><td>'.$p->getTotal().'</td></tr></table></div>';
            $tabRetour['html'] .= '<div class="produit_panier" id="affichageContenuCommande'.$p->getId().'"></div>';
        }
    }
}

echo json_encode($tabRetour);