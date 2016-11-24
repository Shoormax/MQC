<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 16:57
 */
include('../../php/path.php');
include ('../../php/include/init.php');
include ('../../php/classes/CommunTable.php');
include ('../../php/classes/Article.php');

$limit = null;
if(isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    unset($_GET['limit']);
}

$articles = Article::rechercherParParam($_GET, $limit);

foreach ($articles as $article)
{
    $image = false;
    if(!$article->isAccessibilite())
    {
        $extensions_valides = array('jpg' , 'jpeg', 'png');
        $extension_upload = strtolower(  substr(  strrchr($_FILES['fichierimgArticle'.$article->getId()]['name'], '.')  ,1)  );

        if(!empty($_FILES['fichierimgArticle'.$article->getId()]['name'])) {
            if ($_FILES['fichierimgArticle'.$article->getId()]['error'] > 0) {
                $erreur = $_GET['id_langue'] == 1 ? "Erreur lors du transfert." : "Error during upload.";
            }
            else if ($_FILES['fichierimgArticle'.$article->getId()]['size'] > $_POST['MAX_FILE_SIZE']) {
                $erreur = $_GET['id_langue'] == 1 ? "Le fichier est trop gros." : "File is too big.";
            }
            else if (!in_array($extension_upload, $extensions_valides)) {
                $erreur = $_GET['id_langue'] == 1 ? "Format de fichier non valide." : "Invalid file format.";
            }
            else {
                $resultat = move_uploaded_file($_FILES['fichierimgArticle'.$article->getId()]['tmp_name'],'../../img/'.$_FILES['fichierimgArticle'.$article->getId()]['name']);
                if ($resultat) {
                    $image = true;
                }
            }
        }
    }
    $article->setTitreArticle($_POST['tireTexte'.$article->getId()]);
    if($image)$article->setImage('img/'.$_FILES['fichierimgArticle'.$article->getId()]['name']);
    $article->setTitreNavbar($_POST['titreNavBar'.$article->getId()]);
    $article->setTitreShort($_POST['titreShort'.$article->getId()]);
    $article->setShortTexte($_POST['articleShort'.$article->getId()]);
    try {
        $article->update();
        $erreur = $_GET['id_langue'] == 1 ? 'Modifications apportées avec succès.': 'Changes made successfully.';
    }
    catch (Exception $e) {
        $erreur = $e->getMessage();
    }

}
echo '<h2>'.$erreur.'</h2>';
echo $_GET['id_langue'] == 1 ?
'<a href="../administration.php?co=true">Retour administration</a><br><a href="../../index.php">Retourner à l\'accueil</a>' :
'<a href="../administration.php?co=true">Backoffice</a><br><a href="../../index.php">Home</a>' ;