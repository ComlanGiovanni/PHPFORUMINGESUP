<?php
require_once 'include/fonction.php';
log_only();
if(!empty($_POST)){

    if (!empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mot de passe ne correspondent pas";
    } else {
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once "include/basededonne.php";
        $db->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password, $user_id]);
        $_SESSION['flash']['success'] = "Le mot de passe a été mise a jour";
    }

}

require "include/header.php";
?>

<h1>Bonjour <?= $_SESSION['auth']->username?></h1>

<form action="" method="post">
    <div class="form-group">
        <input class ="form-control" type="password" name="password" placeholder="Changer de mot de passe"/>
    </div>

    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confrimation du mot de passe">
    </div>
    <button class="btn btn-primary">Changer mot de passe</button>
</form>

<?php require 'include/footer.php'; ?>
