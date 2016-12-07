<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 27/11/2016
 * Time: 02:11
 */
include_once '../path.php';
include_once '../include/init.php';



$tabRetour = array();
$boutique = Boutique::rechercheParId($_POST['id_boutique']);
$tabRetour['html'] = 'Impossible d\'afficher cette page.';
$tabRetour['status'] = '000012';
$image = '';
if($boutique instanceof Boutique) {
    $tabRetour['html'] = 'Merci renseigner un libelle pour ce produit.';
    $tabRetour['status'] = '000013';
    if(isset($_POST['libelleAjoutProduit']) && !empty($_POST['libelleAjoutProduit'])) {
        $tabRetour['html'] = 'Merci renseigner un prix pour ce produit.';
        $tabRetour['status'] = '000014';
        if(isset($_POST['prixAjoutProduit']) && !empty($_POST['prixAjoutProduit'])) {
            
            $extensions_valides = array('jpg' , 'jpeg', 'png');
            $extension_upload = strtolower(substr(strrchr($_FILES['imageAjoutProduit']['name'], '.')  ,1)  );
            if(!empty($_FILES['imageAjoutProduit']['name'])) {
                if ($_FILES['imageAjoutProduit']['error'] > 0) {
                    $tabRetour['status'] = '000020';
                    $tabRetour['html'] = 'Erreur lors du transfert.';
                }
                else if ($_FILES['imageAjoutProduit']['size'] > $_POST['MAX_FILE_SIZE']) {
                    $tabRetour['status'] = '000021';
                    $tabRetour['html'] = 'Le fichier est trop gros.';
                }
                else if (!in_array($extension_upload, $extensions_valides)) {
                    $tabRetour['status'] = '000022';
                    $tabRetour['html'] = 'Format de fichier non valide.';
                }
                else {
                    $resultat = move_uploaded_file($_FILES['imageAjoutProduit']['tmp_name'],'../../img/'.$_FILES['imageAjoutProduit']['name']);
                    if ($resultat) {
                        $image = 'img/'.$_FILES['imageAjoutProduit']['name'];
                    }
                }
            }
            
            $p = new Produit();
            $produit = $p->add($_POST['libelleAjoutProduit'], $_POST['prixAjoutProduit'], $_POST['stockAjoutProduit'], $_POST['id_boutique'], '', $_POST['descriptionAjoutProduit'], '', $image);
            $tabRetour['html'] = 'Ajout effectué avec succès.';
            $tabRetour['status'] = 1;
        }
    }
}
echo json_encode($tabRetour);