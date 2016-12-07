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
                                            <form id="formModifProduit'.$produit->getId().'" action="php/traitement/modifier_produit.php" method="post" enctype="multipart/form-data">
                                                <span>Libelle : </span><input name="libelleModifProduit" type="text" value="'.$produit->getLibelle().'"/><br>
                                                <span>Prix : </span><input name="prixModifProduit" type="text" value="'.$produit->getPrix().'"/> €<br>
                                                <span>Stock : </span><input name="stockModifProduit" type="text" value="'.$produit->getStock().'"/><br>
                                                <img src="'.$produit->getImage().'" alt="imgProduit'.$produit->getLibelle().'" style="width:300px"/><br>
                                                <span>Lien image : </span><input type="text" value="'.$produit->getImage().'"/><br>
                                                <input type="file" name="imageModifProduit" accept="image/*">
                                                <textarea name="descriptionModifProduit">'.$produit->getDescription().'</textarea><br>
                                                <input type="button" value="Modifier" onclick="modificationProduit('.$produit->getId().', '.$user->getId().')">
                                                <input type="button" value="Supprimer" onclick="supprimerProduit('.$produit->getId().', '.$user->getId().')">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                                                <input type="hidden" name="id_produit" value="'.$produit->getId().'">
                                            </form>
                                        </div>';
            }
            $tabRetour['html'] .= '<div class="apercuProduit">
                                        <form id="formAjoutProduit" action="php/traitement/ajout_produit.php" method="post" enctype="multipart/form-data">
                                            <span>Libelle : </span><input name="libelleAjoutProduit" id="libelleAjoutProduit" type="text" placeholder="Libelle du produit"/><br>
                                            <span>Prix : </span><input name="prixAjoutProduit" id="prixAjoutProduit" type="text" placeholder="Prix du produit"/> €<br>
                                            <span>Stock : </span><input name="stockAjoutProduit" id="stockAjoutProduit" type="text" placeholder="Stock produit"/><br>
                                            <textarea name="descriptionAjoutProduit" id="descriptionAjoutProduit" placeholder="Description du produit"></textarea><br>
                                            <input type="file" name="imageAjoutProduit" accept="image/*">
                                            <input type="button" value="Ajouter" onclick="ajoutProduit('.$boutique->getId().', '.$user->getId().')">
                                            <input type="hidden" name="id_boutique" value="'.$boutique->getId().'">
                                            <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="'.$user->getId().'">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                                        </form>
                                    </div>';
        }
    }
}

echo json_encode($tabRetour);


