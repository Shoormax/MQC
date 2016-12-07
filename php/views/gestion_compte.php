<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 26/11/2016
 * Time: 16:24
 */
include_once('../path.php');
include_once ('../include/init.php');

if(isset($_SESSION['user'])) {
    global $user;
    $user = Utilisateur::rechercheParId($_SESSION['user']);
    if(!$user instanceof Utilisateur) {
        header('Location: ../../boutique.php');
    }
}
else{
    header('Location: ../../boutique.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boutique - Mon Quartier Confluence</title>
    <script src="https://use.fontawesome.com/992faf6002.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="../../img/min/Musee.png" />
    <link rel="stylesheet" href="../../css/boutique.css">
</head>
<body <?php echo 'onload="affichageCommandes('.$user->getId().')"' ?>>
<table>
    <tr>
        <td>
            <?php
            echo '<input type="email" id="emailUtilisateur'.$user->getId().'" value="'.$user->getEmail().'"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<input id="nomUtilisateur'.$user->getId().'" type="text" value="'.$user->getNom().'"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<input id="prenomUtilisateur'.$user->getId().'" type="text"  value="'.$user->getPrenom().'"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<input id="verifPassword'.$user->getId().'" type="password" placeholder="Mot de passe"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<input id="nouveauPassword'.$user->getId().'" type="password" placeholder="Nouveau mot de passe"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<input type="button" value="Modifier" onclick="modificationUtilisateur('.$user->getId().')"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<input type="button" value="Supprimer mon compte" onclick="suppressionCompte('.$user->getId().')"/>';
            echo '</td></tr>';
            echo '<tr><td>';
            echo '<span class="hide" id="retourModif"></span><br>';
            echo '<a href="../../boutique.php">Retour boutique</a>';
            ?>
        </td>
    </tr>
</table>
<?php
echo 'Mes commandes
<div class="tableauCommandes" id="affichageCommandes'.$user->getId().'">
</div>';
?>
</body>
<script src="../../js/gestion_compte.js" type="text/javascript" charset="utf-8" async defer></script>
</html>
