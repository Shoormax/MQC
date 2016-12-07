<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 01:09
 */
include_once '../path.php';
include_once '../include/init.php';

$produit = Produit::rechercheParId($_POST['id_produit']);
$tabRetour = array();
$produits = array();
$tabRetour['html'] = '000012';
$tabRetour['status'] = 'Impossible de modifier ce produit.';

if($produit instanceof Produit) {
    $produit = Produit::rechercheParId($_POST['id_produit']);
    $paniers = Panier::rechercherParParam(array('validation' => 0));
    $tabRetour['status'] = '000011';
    $tabRetour['html'] = 'Impossible de modifier ce produit.';

    if ($produit instanceof Produit) {
        $image = $produit->getImage();
        if ($produit->isUtilise()) {
            $tabRetour['status'] = '000023';
            $tabRetour['html'] = 'Impossible de modifier ce produit car il est actuellement dans un panier non validé.';
        }
        else {
            $tabRetour['html'] = 'Le libelle ne peut être vide.';
            $tabRetour['status'] = '000024';
            if(isset($_POST['libelleModifProduit']) && !empty($_POST['libelleModifProduit'])) {
                $tabRetour['html'] = 'Le prix doit être renseigné.';
                $tabRetour['status'] = '000026';
                if (isset($_POST['prixModifProduit']) && !empty($_POST['prixModifProduit'])) {
                    $tabRetour['status'] = 1;
                    $tabRetour['html'] = 'Modifications effectuées avec succès.';

                    $extensions_valides = array('jpg' , 'jpeg', 'png');
                    $extension_upload = strtolower(substr(strrchr($_FILES['imageModifProduit']['name'], '.')  ,1)  );
                    if(!empty($_FILES['imageModifProduit']['name'])) {
                        if ($_FILES['imageModifProduit']['error'] > 0) {
                            $tabRetour['status'] = '000020';
                            $tabRetour['html'] = 'Erreur lors du transfert.';
                        }
                        else if ($_FILES['imageModifProduit']['size'] > $_POST['MAX_FILE_SIZE']) {
                            $tabRetour['status'] = '000021';
                            $tabRetour['html'] = 'Le fichier est trop gros.';
                        }
                        else if (!in_array($extension_upload, $extensions_valides)) {
                            $tabRetour['status'] = '000022';
                            $tabRetour['html'] = 'Format de fichier non valide.';
                        }
                        else {
                            $resultat = move_uploaded_file($_FILES['imageModifProduit']['tmp_name'],'../../img/'.$_FILES['imageModifProduit']['name']);
                            if ($resultat) {
                                $image = 'img/'.$_FILES['imageModifProduit']['name'];
                            }
                        }
                    }

                    $produit->setImage($image);
                    $produit->setLibelle($_POST['libelleModifProduit']);
                    $produit->setPrix($_POST['prixModifProduit']);
                    $produit->setStock($_POST['stockModifProduit']);
                    $produit->setDescription($_POST['descriptionModifProduit']);
                    $produit->update();
                }
            }
        }
    }
}
echo json_encode($tabRetour);