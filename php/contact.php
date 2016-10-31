<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 26/09/2016
 * Time: 13:46
 */
?>
<div class="article" id="articleContact">
	<div class="moitie fleft" id="contactInfos">
		<input type="text" name="" placeholder="Nom">
		<input type="text" name="" placeholder="Prénom">
		<input id="mail_contact" type="mail" name="email" placeholder="E-m@il">
	</div>
	<div class="moitie fleft">
		<textarea id="messageContact" placeholder="Entrez votre message ici."></textarea>
	</div>
	<input type="button" onclick="alert(emailvalidation())" value="Envoyer">
</div>