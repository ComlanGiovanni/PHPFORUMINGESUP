<?php
session_start();
setcookie('cookie', NULL, -1);

unset($_SESSION['auth']);
/*le faire disparaitre a la deconnexion*/
$_SESSION['flash']['success']='Vous êtes maintenant déconecter';

header('Location:login.php');
