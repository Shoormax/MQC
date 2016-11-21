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
echo '<div class="apercuProduit" onclick="apercuProduit('.$produit->getId().')">';
    echo (string)$produit;echo'<br>';
    echo $produit->getPrix();echo'<br>';
    echo '<img src="'.$produit->getImage().'" alt=""photoarticlemdeir />';echo'<br>';
echo '<input type="number" min="0" max="'.$produit->getStock().'">';
    echo (string)$boutique;echo'<br>';
    echo $boutique->getAdresseComplete('<br>');
    echo'<br>';
    echo'<br>';
echo '</div>';

