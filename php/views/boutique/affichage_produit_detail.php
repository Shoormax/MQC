<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:10
 */
include_once('../../path.php');
include_once ('../../include/init.php');
include_once ('../../classes/CommunTable.php');
include_once ('../../classes/Produit.php');
include_once ('../../classes/Boutique.php');

$produit = Produit::rechercheParId($_GET['produit']);
$boutique = Boutique::rechercheParId($produit->getIdBoutique());
if($produit instanceof Produit) {
    echo 'ID : '.$produit->getId().'<br>';
    echo (string)$produit;echo'<br>';
    echo $produit->getPrix();echo'<br>';
    echo '<img src="../../../'.$produit->getImage().'" alt=""photoarticlemdeir style="width:300px"/>';echo'<br>';
    echo (string)$boutique;echo'<br>';
    echo $boutique->getAdresseComplete('<br>');
    echo'<br>';
    echo'<br>';
    echo '
<a href="../../../boutique.php">Retour</a>';
}

