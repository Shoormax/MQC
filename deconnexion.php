<?php
session_start();
session_destroy();
if(isset($_POST['url']))
  header('Location: '.$_POST['url']);
else
  header('Location: boutique.php');
