<?php

include_once('php/path.php');
include_once ('php/include/init.php');

$articles = Article::rechercherParParam(array('active' => 1), 10);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boutique - Mon Quartier Confluence</title>
  <link rel="stylesheet" href="css/boutique.css">
</head>
<body>
<header>
  <div>Logo</div>
  <div><input type="text" placeholder="Rechercher"></div>
  <div class="compte">
    <?php include('php/views/navbar_compte.php'); ?>
  </div>
</header>
<div id="content">
  <nav>
    <?php
    // todo
    ?>
  </nav>
  <div id="boutique">
    <?php
    if(is_array($articles))
      foreach ($articles as $article )  {
        var_dump($article);
      }
    ?>
  </div>
</div>
</body>
</html>
