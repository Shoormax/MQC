<?php
include_once '../php/path.php';
require_once '../php/include/header.php';
require_once '../php/include/init.php';
?>
<HTML>
<head>

</head>
<body>
<form action="" method="post">
    <input name="email" type="email" autocomplete="off" placeholder="Username">
    <input name="passwd" type="password">
    <input type="submit">
</form>
</body>
</HTML>

<?php
if(isset($_POST) && !empty($_POST)) {
    $user = Utilisateur::rechercherParParam(array("email"=>$_POST['email'], "password"=>$_POST['passwd']), 1);
    if($user instanceof Utilisateur && $user->isAdmin()) {
        $_SESSION['user'] = $user->getId();
        header('Location: administration.php');
    }
    echo 'Couple login/mot de passe incorrect.';
}