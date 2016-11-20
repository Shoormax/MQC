<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 26/09/2016
 * Time: 13:46
 */
?>
    <div id="'.$a->getTitreNavbar().'" class="sous-container">
        <div class="article" id="articleContact">
            <form method="post" action="#Contact">
                <div class="moitie fleft" id="contactInfos">
                    <input type="text" name="nom" placeholder="Nom">
                    <input type="text" name="prenom" placeholder="Prénom">
                    <input id="mail_contact" type="mail" name="email" placeholder="E-mail">
                </div>
                <div class="moitie fleft">
                    <textarea id="messageContact" name="messageContact" placeholder="Entrez votre message ici."></textarea>
                </div>
                <input class="button" type="submit" value="Envoyer"">
            </form>
        </div>
    </div>

<?php
if(!empty($_POST)) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $userMail = $_POST['email'];
    $contenu = $_POST['messageContact'];

    if(empty($nom)) {
        echo '<div id="errorMail">Veuillez entrer votre prénom.</div>';
    }
    else if(empty($prenom)){
        echo '<div id="errorMail">Veuillez entrer votre nom.</div>';
    }
    else if(empty($userMail) || !preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $userMail)) {
        echo '<div id="errorMail">Veuillez entrer une adresse email valide.</div>';
    }
    else if(empty($contenu)) {
        echo '<div id="errorMail">Veuillez entrer un message.</div>';
    }
    else{
        require_once ('mail.php');
        echo '<div id="errorMail">'.$tabRetour['message'].'</div>';
    }
}

