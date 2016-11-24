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
if(isset($_GET['detail'])) {
    include 'affichage_produit_detail.php';
}else {
    $boutique = Boutique::rechercheParId($produit->getIdBoutique());

echo '<a href="php/views/boutique/affichage_produits.php?detail=true&produit='.$produit->getId().'">
        <div class="apercuProduit" id="apercuProduit'.$produit->getId().'">';
    echo 'ID : '.$produit->getId().'<br>';
    echo (string)$produit;echo'<br>';
    echo $produit->getPrix();echo'<br>';
    echo '<img src="'.$produit->getImage().'" alt=""photoarticlemdeir style="width:300px"/>';echo'<br>';
    echo (string)$boutique;echo'<br>';
    echo $boutique->getAdresseComplete('<br>');
    echo'<br>';
    echo'<br>';
    echo '</a>';
    echo '<input type="button" class="button" onclick="modificationQuantite(\'-\','.$produit->getId().')" value="-"><input class="nombreProduit" id="nombreProduit'.$produit->getId().'" type="text" value="0"><input type="button" class="button" value="+" onclick="modificationQuantite(\'+\','.$produit->getId().','.$produit->getStock().')">';
    echo '</div>';
}