<?php

include_once('php/path.php');
include_once ('php/include/init.php');

if(isset($_POST['connexion'])) {
    include('php/traitement/connexion.php');
}
if(isset($_SESSION['user'])) {
    global $user;
    $user = Utilisateur::rechercheParId($_SESSION['user']);
}
$produits = Produit::rechercherParParam(array('active' => 1));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boutique - Mon Quartier Confluence</title>
    <script src="https://use.fontawesome.com/992faf6002.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="img/min/Musee.png" />
    <link rel="stylesheet" href="css/boutique.css">
</head>
<body <?php echo isset($_SESSION['user']) ? 'onload="refreshAffichagePanier('.$user->getId().')"' : '' ?>>
<header>
    <div class="extremite"><a href="deconnexion.php?retour=index"><img style="width: 3vw" src="img/min/Musee.png" alt="Logo"/></a></div>
    <div id="rechercheProduit">
        <input id="autoComplementationProduit" type="text" placeholder="Rechercher un produit..." onkeyup="rechercheProduit()">
    </div>
    <div class="extremite">
        <?php
        if($user instanceof Utilisateur) {
            echo '<a id="affichageCompte" href="php/views/gestion_compte.php"><i class="fa fa-user-circle" aria-hidden="true"></i></a>';
            echo '<span>Bonjour '.(string)$user.'</span>';
            echo '<p><a href="./deconnexion.php">Déconnexion</a></p>';
            if($user->isSuperUser()) {
                echo '<div id="gestionProduits" onclick="gestionProduits('.$user->getId().')"><i class="fa fa-product-hunt" aria-hidden="true"></i>Gérer mes produits</div>';
            }
            if($user->isAdmin()) {
                echo '<div id="gestionBoutiques" onclick="gestionBoutique('.$user->getId().')"><i class="fa fa-address-book" aria-hidden="true"></i>Gérer mes boutiques</div>';
            }
        } else {
            echo '<a href="./connexion.php">Connexion</a>';
        }

        ?>
    </div>
</header>
<div id="content">
    <nav>
        <?php
        //@todo
        ?>
    </nav>
    <div id="boutique">
        <?php
        foreach ($produits as $produit) {
            include 'php/views/boutique/affichage_produits.php';
        }
        ?>
    </div>
    <?php
    if(isset($_SESSION['user'])) {
        include 'php/views/boutique/panier.php';
    }
    ?>
</div>
<?php
include 'php/views/boutique/affichageErreur.php';
include 'php/views/boutique/affichageOk.php';
?>
<script src="js/boutique.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
