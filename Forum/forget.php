<?php
if(!empty($_POST) && !empty($_POST['email'])){
    require_once 'include/basededonne.php';
    require_once 'include/fonction.php';
    $req = $db->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        session_start();
        $reset_token = str_random(60);
        $db->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token,$user->id]);
        $_SESSION ['flash']['success']= "Le lien a éte envoyé par email";
        mail($_POST['email'],'reeeu de mot de passe',"ergareg \n\nhttp://127.0.0.1/forum2/reset.php?id=($user->id)&token=$reset_token");
        header('Location: login.php');
        exit();
    }else{
        $_SESSION['flash']['danger']= 'Aucun compte ne corresponds à ce email';
    }
}else{
    $_SESSION['flash']['danger']= 'Remplir tous les champs!';
}
?>


<?php require "include/header.php"; ?>

<div class="container">
    <h1>Mot de passe oublié</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Email</label>
            <input required type="email" name="email" class="form-control"/>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>

<?php require 'include/footer.php'; ?>
