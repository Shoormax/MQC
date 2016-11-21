<?php

include_once('php/path.php');
include_once ('php/include/init.php');

$sMessageErreurConnexion = '';
$sMessageErreurInscription = '';

if(isset($_POST['connexion'])) {
  include('php/traitement/connexion.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Connexion - Mon Quartier Confluence</title>
  <link rel="icon" type="image/png" href="img/min/Musee.png" />
  <link rel="stylesheet" href="css/connexion.css">
</head>
<body>

<div id="content">
  <?php include (__VIEW_PATH__.'connexion.php'); ?>
</nav>
</div>
<script src="js/boutique.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
