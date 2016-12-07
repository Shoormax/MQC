<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 05/12/2016
 * Time: 17:48
 */
include_once '../../path.php';
include_once '../../include/init.php';
$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
$tabRetour['status'] = '000017';
$tabRetour['html'] = 'Impossible d\'afficher cette page.';

if($user instanceof Utilisateur && $user->isAdmin()) {
    $tabRetour['status'] = 1;
    $tabRetour['html'] = '';

    foreach (Boutique::rechercheAll() as $boutique) {
        $tabRetour['html'] .=  '<div class="apercuProduit" id="modificationBoutique'.$boutique->getId().'">
            <div class="lesInputs"><span>Libelle :</span><input id="libelleBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getLibelle().'"/></div>
            <div class="lesInputs"><span>Adresse :</span><input id="adresseBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getAdresse().'"/></div>
            <div class="lesInputs"><span>Code postal :</span><input id="codePostalBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getCodePostal().'"/></div>
            <div class="lesInputs"><span>Ville :</span><input id="villeBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getVille().'"/></div>
            <input type="button" value="Modifier" onclick="modificationBoutique('.$boutique->getId().', '.$user->getId().')">
            <input type="button" value="Supprimer" onclick="suppressionBoutique('.$boutique->getId().', '.$user->getId().')">
        </div>';
    }
    $tabRetour['html'] .= '<div class="apercuProduit">
                            <div class="lesInputs"><span>Libelle : </span><input id="libelleAjoutBoutique" type="text" placeholder="Libelle"/></div>
                            <div class="lesInputs"><span>Adresse : </span><input id="adresseAjoutBoutique" type="text" placeholder="Adresse"/></div>
                            <div class="lesInputs"><span>Code postal : </span><input id="codePostalAjoutBoutique" type="text" placeholder="Code"/></div>
                            <div class="lesInputs"><span>Ville : </span><input id="villeAjoutBoutique" type="text" placeholder="Ville"/></div>
                            <input type="button" value="Ajouter" onclick="ajoutBoutique('.$user->getId().')">
                        </div>';
}

echo json_encode($tabRetour);