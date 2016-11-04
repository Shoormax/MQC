<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 26/09/2016
 * Time: 13:46
 */
?>
<div class="article" id="articleContact">
	<h3>Contact</h3>
	<div class="flexbox">
		<div class="moitie" id="contactInfos">
			<input type="text" name="" placeholder="Nom">
			<input type="text" name="" placeholder="Prénom">
			<input id="mail_contact" type="mail" name="email" placeholder="Email">
		</div>
		<div class="moitie">
			<textarea id="messageContact" placeholder="Entrez votre message ici." rows="10"></textarea>
			<input type="button" onclick="emailvalidation()" value="Envoyer">
		</div>
	</div>
	<div id="errorMail" class="hide"></div>
</div>