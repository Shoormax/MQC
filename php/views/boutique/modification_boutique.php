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
            <span>Libelle :</span><input id="libelleBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getLibelle().'"/><br>
            <span>Adresse :</span><input id="adresseBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getAdresse().'"/><br>
            <span>Code postal :</span><input id="codePostalBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getCodePostal().'"/><br>
            <span>Ville :</span><input id="villeBoutique'.$boutique->getId().'" type="text" value="'.$boutique->getVille().'"/><br>
            <input type="button" value="Modifier" onclick="modificationBoutique('.$boutique->getId().', '.$user->getId().')">
            <input type="button" value="Supprimer" onclick="suppressionBoutique('.$boutique->getId().', '.$user->getId().')">
        </div>';
    }
    $tabRetour['html'] .= '<div class="apercuProduit">
                            <span>Libelle : </span><input id="libelleAjoutBoutique" type="text" placeholder="Libelle de la boutique"/><br>
                            <span>Adresse : </span><input id="adresseAjoutBoutique" type="text" placeholder="Adresse de la boutique"/><br>
                            <span>Code postal : </span><input id="codePostalAjoutBoutique" type="text" placeholder="Code postal de la boutique"/><br>
                            <span>Ville : </span><input id="villeAjoutBoutique" type="text" placeholder="Ville de la boutique"/><br>
                            <input type="button" value="Ajouter" onclick="ajoutBoutique('.$user->getId().')">
                        </div>';
}

echo json_encode($tabRetour);