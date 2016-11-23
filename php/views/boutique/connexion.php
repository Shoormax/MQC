
<form action="php/traitement/connexion.php" method="POST">
  <input type="hidden" name="connexion" value="connexion">
  <legend>Connexion</legend>
  <input type="mail" name="email" id="email" placeholder="Email">
  <input type="password" name="password" id="password" placeholder="Mot de passe">
  <input type="submit" name="subConnexion" value="Connexion">

  <?php
  if(isset($GLOBALS['sMessageErreurConnexion'])) echo '<span class="red">'.$GLOBALS['sMessageErreurConnexion'].'</span>' ?>
</form>
<form action="php/traitement/connexion.php" method="POST">
  <input type="hidden" name="connexion" value="inscription">
  <legend>Inscription</legend>
  <input type="email" name="email" id="email" placeholder="Adresse Mail">
  <input type="text" name="nom" id="nom" placeholder="Nom">
  <input type="text" name="prenom" id="prenom" placeholder="Prenom">
  <input type="password" name="password" id="password" placeholder="Mot de passe">
  <input type="submit" name="subInscription" value="Inscription">
  <?php
  if(isset($GLOBALS['sMessageErreurInscription']))
    echo '<span class="red">'.$GLOBALS['sMessageErreurInscription'].'</span>';
  ?>
</form>
