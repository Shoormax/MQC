<HTML>
<head>

</head>
<body>
<form action="" method="post">
    <input name="username" type="text" autocomplete="off" placeholder="Username">
    <input name="passwd" type="password">
    <input type="submit">
</form>
</body>
</HTML>

<?php
if(isset($_POST['username']) && isset($_POST['passwd']) && $_POST['username'] == 'mqc' && $_POST['passwd'] == 'c83g9q') {
    redir("administration.php");
}
else {

}

function redir($url)
{
    echo "<script language=\"javascript\">";
    echo "window.location='$url';";
    echo "window.location.href='administration.php?co=true'";
    echo "</script>";
}