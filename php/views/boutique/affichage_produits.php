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
'.(string)$produit.'<br>
'.$produit->getPrix().' €<br>
<img src="'.$produit->getImage().'" alt="imgArticle'.$produit->getLibelle().'" style="width:300px"/><br>
'.(string)$boutique.'<br>
'.$boutique->getAdresseComplete('<br>'). '
<br>
<br>
<input type="button" class="button" onclick="modificationQuantite(\'-\','.$produit->getId().')" value="-"><input class="nombreProduit" id="nombreProduit'.$produit->getId().'" type="text" value="0" '.($produit->getStock() == 0 ? 'readonly' : '' ).'><input type="button" class="button" value="+" onclick="modificationQuantite(\'+\','.$produit->getId().','.$produit->getStock().')"><br>
<a class="addToCart" onclick="ajoutPanier('.($user instanceof Utilisateur ? $user->getId() : 0).','.$produit->getId().')"><i class="fa fa-spinner hide" aria-hidden="true" id="inputAjoutPanierLoader'.$produit->getId().'"></i><i id="inputAjoutPanier'.$produit->getId().'" class="fa fa-cart-plus" aria-hidden="true"></i></a><br>
<a class="redirectDetail" onclick="redirectProduitDetaille('.$produit->getId().')">Voir la fiche détaillée</a>
</div>';
