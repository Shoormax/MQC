<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 25/11/2016
 * Time: 00:17
 */
include_once('../../path.php');
include_once ('../../include/init.php');


$tabRetour['html'] = 'Il vous faut être connecté pour pouvoir ajouter des produits au panier.';
$tabRetour['status'] = '000001';
$user = null;
if(isset($_POST['id_utilisateur']) && $_POST['id_utilisateur'] > 0)
{
    $user = Utilisateur::rechercheParId($_POST['id_utilisateur']);
}
if(!isset($_POST['id_produit']) || $_POST['id_produit'] <= 0){
    $tabRetour['html'] = 'Erreur lors de l\'ajout de ce produit au panier, veuillez réessayer.';
    $tabRetour['status'] = '000003';
}
else {
    if($user instanceof Utilisateur) {
        $quantite = 1;
        $produit = Produit::rechercheParId($_POST['id_produit']);
        if($produit instanceof Produit) {
            $tabRetour['html'] = 'Erreur lors de la sortie de stock, la quantité maximale que vous pouvez sortir est '.$produit->getStock().'.';
            $tabRetour['status'] = '000004';
            if($quantite <= $produit->getStock()) {
                $panier = Panier::rechercherParParam(array('id_utilisateur' => $user->getId(), 'validation' => 0), 1);
                if(!$panier instanceof Panier) {
                    $pa = new Panier();
                    $panier = $pa->add($user->getId());
                }
                try{
                    $panier->ajoutProduit($produit->getId(), $quantite);
                    $tabRetour['status'] = 1;
                    //Pas de retour sur l'ajout car panier visuellement actualisé
                    $tabRetour['html'] = '';
                    $tabRetour['stock'] = $produit->getLibelle().' ('.($produit->getStock()-$quantite).')';
                }
                catch (Exception $e) {
                    $tabRetour['status'] = $e->getCode();
                    $tabRetour['html'] = $e->getMessage();
                }
            }
        }
    }
}
echo json_encode($tabRetour);