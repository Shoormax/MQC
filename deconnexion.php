<?php
session_start();
session_destroy();

if(isset($_POST['url']))
  header('Location: '.$_POST['url']);
elseif(isset($_GET['retour']))
    header('Location: '.$_GET['retour'].'.php');
else
  header('Location: boutique.php');
