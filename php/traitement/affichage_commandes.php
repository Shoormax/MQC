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
        $tabRetour['html'] = '<div class="titreCommande">Mes Commandes</div><div class="recap_commandes"><span>Créé le</span><span>Validé le</span><span>Total (€)</span><span></span></div><div class="traitBlanc"></div>';
        foreach($paniers as $p) {
            $tabRetour['html'] .= '<div class="recap_commandes pointer" onclick="affichage_contenu_commande('.$p->getId().')"><span>'.$p->getDateAdd(true).'</span><span>'.$p->getDateUpd(true).'</span><span>'.$p->getTotal().'</span><span><a href="../traitement/facturation.php?id='.$p->getId().'" target="_blank">Facture</a></span></div>';
            $tabRetour['html'] .= '<div class="produit_panier" id="affichageContenuCommande'.$p->getId().'"></div>';
        }
    }
}

echo json_encode($tabRetour);