<?php

function connexion($id, $mdp) {
  $user = Utilisateur::rechercherParParam(array("id_utilisateur"=>$id, "password"=>$mdp));
  if(!$user instanceof Utilisateur) {
    return false;
  }
}

if(isset($_POST['connexion'])) {
  if($_POST['connexion'] == 'connexion' && isset($_POST['ndc'], $_POST['psw'])) {
    connexion($_POST['ndc'], $_POST['psw']);
  }
}
