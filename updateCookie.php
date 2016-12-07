<?php

if(empty($_COOKIE["langue"])) {
  setcookie("langue", 1, time()+80000);
}

if(isset($_GET['language'])) {
  setcookie("langue", $_GET['language']);
}

$location = empty($_GET['url']) ? 'index.php' : $_GET['url'];

header('Location: '.$location);
