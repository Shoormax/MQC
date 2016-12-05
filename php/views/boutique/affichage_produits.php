<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 02:15
 */
/**
 * Vue appelée pour afficher
 */
$boutique = Boutique::rechercheParId($produit->getIdBoutique());

echo '<div class="apercuProduit" id="apercuProduit'.$produit->getId().'">
<img src="'.$produit->getImage().'" alt="imgArticle'.$produit->getLibelle().'" />
<div class="infosProduit">
<p><span id="libelleProduitAffichage'.$produit->getId().'">'.(string)$produit.'</span><a class="addToCart" onclick="ajoutPanier('.($user instanceof Utilisateur ? $user->getId() : 0).','.$produit->getId().')"><i id="inputAjoutPanier'.$produit->getId().'" class="fa fa-plus-circle" aria-hidden="true"></i></a></p>
<p class="prixArticle">'.$produit->getPrix().' € </p>
<p>'.(string)$boutique.'</p>
<p class="redirectDetail" ><a onclick="redirectProduitDetaille('.$produit->getId().')">Voir la fiche détaillée</a></p>
</div>
</div>';


//<input type="button" class="button" onclick="modificationQuantite(\'-\','.$produit->getId().')" value="-"><input class="nombreProduit" id="nombreProduit'.$produit->getId().'" type="text" value="0" '.($produit->getStock() == 0 ? 'readonly' : '' ).'><input type="button" class="button" value="+" onclick="modificationQuantite(\'+\','.$produit->getId().','.$produit->getStock().')"><br>
