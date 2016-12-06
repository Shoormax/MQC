<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 19:06
 */
include_once('../../path.php');
include_once ('../../include/init.php');

$user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
$tabRetour['html'] = 'Impossible d\'afficher cette page.';
$tabRetour['status'] = '000007';

if($user instanceof Utilisateur && $user->isSuperUser()) {
    $boutiques = $user->getBoutique();
    $tabRetour['html'] = '';
    $tabRetour['status'] = 1;
    foreach ($boutiques as $b) {
        $boutique = Boutique::rechercheParId($b['id_boutique']);
        $produits = $boutique->getProduits();
        if(empty($produits)) {
            $tabRetour['html'] = 'Cette boutique n\'a aucun produit.';
        }
        else {
            foreach ($produits as $produit) {
                $tabRetour['html'] .=  '<div class="apercuProduit" id="apercuProduit'.$produit->getId().'">
                                            <span>Libelle : </span><input id="libelleProduit'.$produit->getId().'" type="text" value="'.$produit->getLibelle().'"/><br>
                                            <span>Prix : </span><input id="prixProduit'.$produit->getId().'" type="text" value="'.$produit->getPrix().'"/> €<br>
                                            <span>Stock : </span><input id="stockProduit'.$produit->getId().'" type="text" value="'.$produit->getStock().'"/><br>
                                            <img src="'.$produit->getImage().'" alt="imgProduit'.$produit->getLibelle().'" style="width:300px"/><br>
                                            <span>Lien image : </span><input type="text" value="'.$produit->getImage().'"/><br>
                                            <textarea id="descriptionProduit'.$produit->getId().'">'.$produit->getDescription().'</textarea><br>
                                            <input type="button" value="Modifier" onclick="modificationProduit('.$produit->getId().', '.$user->getId().')">
                                            <input type="button" value="Supprimer" onclick="supprimerProduit('.$produit->getId().', '.$user->getId().')">
                                        </div>';
            }
            $tabRetour['html'] .= '<div class="apercuProduit">
                                        <span>Libelle : </span><input id="libelleAjoutProduit" type="text" placeholder="Libelle du produit"/><br>
                                        <span>Prix : </span><input id="prixAjoutProduit" type="text" placeholder="Prix du produit"/> €<br>
                                        <span>Stock : </span><input id="stockAjoutProduit" type="text" placeholder="Stock produit"/><br>
                                        <textarea id="descriptionAjoutProduit" placeholder="Description du produit"></textarea><br>
                                        <input type="button" value="Ajouter" onclick="ajoutProduit('.$boutique->getId().', '.$user->getId().')">
                                    </div>';
        }
    }
}

echo json_encode($tabRetour);


