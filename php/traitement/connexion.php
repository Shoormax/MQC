<?php
include_once '../path.php';
require_once '../include/header.php';
require_once '../include/init.php';

function connexion($email, $mdp) {
    $user = Utilisateur::rechercherParParam(array("email"=>$email, "password"=>$mdp), 1);

    if($user instanceof Utilisateur) {
        $_SESSION['user'] = $user->getId();

        if (isset($_POST['pagePrecedente'])) {
            header('Location: ' . __LOCAL_PATH__ . '/' . $_POST['pagePrecedente']);
        } else {
            header('Location: ' . __LOCAL_PATH__ . '/boutique.php');
        }
    } else {
        header('Location: ' . __LOCAL_PATH__ . '/connexion.php?error=true');
        return false;
    }
}

function inscription($nom, $prenom, $email, $mdp) {
    $u = new Utilisateur();
    $user = $u->add(3, $nom, $prenom, $email, $mdp);
    if(!$user instanceof Utilisateur) {
        header('Location: ' . __LOCAL_PATH__ . '/connexion.php');
        return false;
    } else {
        $mail = new Mail($user->getEmail(), 'Inscription MonQuartierConfluence', 'Merci pour votre inscription à notre site, nous expérons que vous y trouverez ce que vous cherchez. En cas de prolème n\'hésitez pas à nous contacter.', 'FROM : no-reply@monquartierconfluence.fr');
        $mail->send();
        connexion($email, $mdp);
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