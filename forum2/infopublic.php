<?php
require "include/headerparm.php";
require 'include/basededonne.php';
require_once 'include/fonction.php';
log_only();
$req = $db -> prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$_SESSION['auth']->id]);
$user = $req-> fetch();
/*
debug($user);
*/

/*
 * photo uploader
 * */
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
