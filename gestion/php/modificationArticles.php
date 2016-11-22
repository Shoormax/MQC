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
$image = false;
$extensions_valides = array('jpg' , 'jpeg', 'png');
$extension_upload = strtolower(  substr(  strrchr($_FILES['fichierimgArticle1']['name'], '.')  ,1)  );
if(!empty($_FILES['fichierimgArticle1']['name'])) {
    if ($_FILES['fichierimgArticle1']['error'] > 0) {
    $erreur = "Erreur lors du transfert.";
    }
    else if ($_FILES['fichierimgArticle1']['size'] > $_POST['MAX_FILE_SIZE']) {
        $erreur = "Le fichier est trop gros.";
    }
    else if (!in_array($extension_upload,$extensions_valides)) {
        $erreur = "L'extension entrée n'est pas correcte.";
    }
    else {
        $resultat = move_uploaded_file($_FILES['fichierimgArticle1']['tmp_name'],'../../img/'.$_FILES['fichierimgArticle1']['name']);
        if ($resultat) {
            $image = true;
        }
    }
}

foreach ($articles as $article)
{
    $article->setTitreArticle($_POST['tireTexte'.$article->getId()]);
    if($image)$article->setImage('img/'.$_FILES['fichierimgArticle1']['name']);
    $article->setTitreNavbar($_POST['titreNavBar'.$article->getId()]);
    $article->setTitreShort($_POST['titreShort'.$article->getId()]);
    $article->setShortTexte($_POST['articleShort'.$article->getId()]);
    try {
        $article->update();
        $erreur = 'Modifications apportées avec succès.';
    }
    catch (Exception $e) {
        $erreur = $e->getMessage();
    }

}
echo '<h2>'.$erreur.'</h2>';
echo '<a href="../administration.php?co=true">Retour administration</a><br><a href="../../index.php">Retour site</a>';