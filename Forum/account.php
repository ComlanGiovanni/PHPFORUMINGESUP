<?php
require 'include/header.php';
require_once 'include/fonction.php';

log_only();
/*
 *
 *On inclue le header et le footer
 *On fait appel a la fontion qui autorise l'acces a une page
 *On afficher les information de l'utilisateur que l'on veux bien affiché
 *Readonly
 *Information vue par tout le monde
 *Avatar pero
 *On inclue le footer
 *
 *
 */

?>

<div class="container">
    <h1>Bonjour <?= $_SESSION['auth']->username ?></h1>
    <h1>Votre ID : <?= $_SESSION['auth']->id ?></h1>
    <h1>Mail: <?= $_SESSION['auth']->email ?></h1>
    <h1>Date de validation <?= $_SESSION['auth']->confirmed_at ?></h1>
</div>

<?php require 'include/footer.php'; ?>
