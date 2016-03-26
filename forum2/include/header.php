<?php
/*Si le statut de la session est egale a phphsessionnon
je demarre une session*/
if(session_status() == PHP_SESSION_NONE){/*SI ON NA PAS DE SESSION*/
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Projet</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/boostrapcyborg.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home</a></li>
                <!-- Comment il trouve cett pu** de page ?????-->
                <?php if(isset($_SESSION['auth'])): ?>
                    <li><a href="modifcompte.php">Mofie mes info</a></li>
                    <li><a href="logout.php">Deconnexion</a></li>
                <?php else: ?>
                    <li><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <?php if(isset($_SESSION['flash'])):?>

        <?php foreach($_SESSION['flash'] as $type => $message):?>
            <div class="alert alert-<?= $type; ?>">

                <?= $message; ?>

            </div>
        <?php endforeach; ?>

        <?php unset($_SESSION["flash"]); ?>
    <?php endif; ?>

     <?php if(isset($_SESSION['flash2'])):?>

        <?php foreach($_SESSION['flash2'] as $type => $message2):?>
            <div class="alert alert-<?= $type; ?>">

                <?= $message2; ?>

            </div>
        <?php endforeach; ?>

        <?php unset($_SESSION["flash2"]); ?>
    <?php endif; ?>