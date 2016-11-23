<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 03/11/2016
 * Time: 09:21
 */
$to = 'valentin.derudet2@gmail.com';
$sujet = 'Commentaires MQC';
$tabRetour['message'] = "L'email a bien été envoyé.";

$passage_ligne = "\r\n";

$boundary = "-----=".md5(rand());
$header = "From:".$userMail.$passage_ligne;
$header .= "MIME-Version: 1.0".$passage_ligne;
$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;


$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$contenu.$passage_ligne;
$message.= $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$contenu.$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

try{
    mail($to,$sujet,$message,$header);
}catch (Exception $e) {
    $tabRetour['message'] = "Erreur lors de l'envoie du mail.";
}


