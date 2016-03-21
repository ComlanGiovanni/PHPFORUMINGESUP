<?php
session_start();
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    header('Location:/forum/index.php');
}
else{
    echo htmlentities($_SESSION['id']);
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<br>
<a href="deconnexion.php">Deco</a>
<a href="edition.php">Edition</a>
</body>
</html>