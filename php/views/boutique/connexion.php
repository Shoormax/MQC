<form action="boutique.php" method="POST">
  <input type="hidden" name="connexion" value="connexion">
  <legend>Connexion</legend>
  <input type="text" name="ndc" id="ndc" placeholder="Identifiant">
  <input type="password" name="psw" id="psw" placeholder="Mot de passe">
  <input type="submit" name="subConnexion" value="Connexion">
</form>
<form action="boutique.php" method="POST">
  <input type="hidden" name="connexion" value="inscription">
  <legend>Inscription</legend>
  <input type="text" name="ndc" id="ndc" placeholder="Identifiant">
  <input type="mail" name="mail" id="mail" placeholder="Adresse Mail">
  <input type="password" name="psw" id="psw" placeholder="Mot de passe">
  <input type="submit" name="subInscription" value="Inscription">
</form>
<?php if(isset($sMessageErreurConnexion)) echo $sMessageErreurConnexion; ?>
