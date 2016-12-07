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
        foreach ($produits as $produit) {
            $tabRetour['html'] .=  '<div class="apercuProduit" id="apercuProduit'.$produit->getId().'">
                                            <form id="formModifProduit'.$produit->getId().'" action="php/traitement/modifier_produit.php" method="post" enctype="multipart/form-data">
                                                <div class="lesInputs"><span>Libelle : </span><input name="libelleModifProduit" type="text" value="'.$produit->getLibelle().'"/></div>
                                                <div class="lesInputs"><span>Prix (€) : </span><input name="prixModifProduit" type="text" value="'.$produit->getPrix().'"/></div>
                                                <div class="lesInputs"><span>Stock : </span><input name="stockModifProduit" type="text" value="'.$produit->getStock().'"/></div>
                                                <img src="'.$produit->getImage().'" alt="imgProduit'.$produit->getLibelle().'" style="margin-bottom:4%"/>
                                                <input type="file" name="imageModifProduit" accept="image/*">
                                                <textarea class="descriptionProduitModif" name="descriptionModifProduit">'.$produit->getDescription().'</textarea
                                                <input class="buttonModif" type="button" value="Modifier" onclick="modificationProduit('.$produit->getId().', '.$user->getId().')">
                                                <input class="buttonModif" type="button" value="Supprimer" onclick="supprimerProduit('.$produit->getId().', '.$user->getId().')">
                                                <input class="buttonModif" type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                                                <input type="hidden" name="id_produit" value="'.$produit->getId().'">
                                            </form>
                                        </div>';
        }
        $tabRetour['html'] .= '<div class="apercuProduit">
                                        <form id="formAjoutProduit" action="php/traitement/ajout_produit.php" method="post" enctype="multipart/form-data">
                                            <div  class="lesInputs"><span>Libelle : </span><input name="libelleAjoutProduit" id="libelleAjoutProduit" type="text" placeholder="Libelle du produit"/></div>
                                            <div  class="lesInputs"><span>Prix (€) : </span><input name="prixAjoutProduit" id="prixAjoutProduit" type="text" placeholder="Prix du produit"/></div>
                                            <div  class="lesInputs"><span>Stock : </span><input name="stockAjoutProduit" id="stockAjoutProduit" type="text" placeholder="Stock produit"/></div>
                                            <textarea class="descriptionProduitModif" name="descriptionAjoutProduit" id="descriptionAjoutProduit" placeholder="Description du produit"></textarea>
                                            <input type="file" style="margin-bottom:4%" name="imageAjoutProduit" accept="image/*">
                                            <input  class="buttonModif" type="button" value="Ajouter" onclick="ajoutProduit('.$boutique->getId().', '.$user->getId().')">
                                            <input type="hidden" name="id_boutique" value="'.$boutique->getId().'">
                                            <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="'.$user->getId().'">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                                        </form>
                                    </div>';
    }
}

echo json_encode($tabRetour);


