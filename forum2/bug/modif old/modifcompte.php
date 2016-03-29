<?php
require 'include/fonction.php';

log_only();

/*verifier que des donner on ete poster*/
/*
 * si post n'existe pas et qu'il est vide
 * non
 * sinon
 * bad
 *
 * readonly
 * information vue par tout le monde
 * avatar pero
 * */

if(empty($_POST['password']) || empty($_POST['password_confirm']) && $_POST == null){

    $_SESSION['flash']['danger'] = "Veillez remplir tout les champs";
}else{
    /*bon je ne sais pas pourquoi ça bug ici  && $mdpsec2 > 8*/
    $mdpsec2 =strlen($_POST['password']);
    if ($_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mot de passes ne correspondent pas";
    }else if($_POST['password'] = $_POST['password_confirm'] && $_POST['password']){
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
<!--https://www.youtube.com/watch?v=fM5ZV2AaIjE-->
<!--ajout d'une petite description-->
<form action="" method="post">
    <div class="form-group">
        <input class ="form-control" type="password" name="password" placeholder="Changer de mot de passe"/>
    </div>

    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confrimation du mot de passe">
    </div>
    <button class="btn btn-primary">Changer mot de passe</button>
    <p>pseudo, mail etc...</p>
</form>

<?php require 'include/footer.php'; ?>
