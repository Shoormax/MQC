<?php

function connexion($email, $mdp) {
  global $sMessageErreurConnexion;

  $user = Utilisateur::rechercherParParam(array("email"=>$email, "password"=>$mdp));

//  if($user instanceof Utilisateur) {
  if(!empty($user) ) {
    $_SESSION['user'] = $user;
    if (isset($_POST['pagePrecedente'])) {
      header('Location: ' . __LOCAL_PATH__ . '/' . $_POST['pagePrecedente']);
    } else {
      header('Location: ' . __LOCAL_PATH__ . '/boutique.php');
    }
  } else {
    $GLOBALS['sMessageErreurConnexion'] = 'Identifiants Incorrects';
    return false;
  }
}

function inscription($nom, $prenom, $email, $mdp) {
  global $sMessageErreurInscription;
  $user = new Utilisateur();

  if(!$user->add(1, $nom, $prenom, $email, $mdp)) {
    $GLOBALS['sMessageErreurInscription'] = 'Erreur vérifiez les champs';
    return false;
  } else {
    connexion($email, $mdp);
  }

  if(!$user instanceof Utilisateur) {
  }
}

if(isset($_POST['connexion'])) {
  if($_POST['connexion'] == 'connexion'
    && isset($_POST['email'], $_POST['password'])) {

    connexion($_POST['email'], $_POST['password']);

  } else if($_POST['connexion'] == 'inscription' &&
    isset(
      $_POST['nom'],
      $_POST['prenom'],
      $_POST['password'],
      $_POST['email']
    )
  ) {

    inscription($_POST['nom'],
      $_POST['prenom'],
      $_POST['email'],
      $_POST['password']);

  }
}

// todo Le passage des messages erreur via GLOBALS ne marche pas COMPREND PO POURQUOI MDR TORP NOOB JE SUIS FDP LOL