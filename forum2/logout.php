<?php
session_start();
setcookie('cookie', NULL, -1);

unset($_SESSION['auth']);

$_SESSION['flash']['success']="Vous êtes maintenant déconecter";

header('Location:login.php');
