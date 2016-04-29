<?php
require "include/header.php";
require 'include/basededonne.php';
require_once 'include/fonction.php';
log_only();

if(isset($_GET['id']) AND $_GET['id'] > 0) {
    /*Securisation de la varible entrer en nombre*/
    /*$getid = intval($_GET['id']);*/
    $req = $db -> prepare('SELECT * FROM users WHERE id = ?');
    $req->execute([$_GET['id']]);
    $user = $req-> fetch();
}
?>
<div class="container">
    <p><?=$user->id?></p>
    <p><?=$user->username?></p>
    <p><?=$user->email?></p>
    <p><?=$user->confirmed_at?></p>
    <h1><?=$user->statut?></h1>
    <p><?=$user->numérotel?></p>
    <p><?=$user->dateaniv?></p>
    <p><?=$user->sexe?></p>
    <p><?=$user->age?> ans</p>
    <p><?=$user->nation?></p>
    <p><?=$user->taille?></p>
    <p><?=$user->religion?></p>
    <p><?=$user->statutsocial?></p>
    <a href="<?=$user->lien?>" target="_blank"><?=$user->lien?></a>

</div>
<?php require 'include/footer.php'; ?>