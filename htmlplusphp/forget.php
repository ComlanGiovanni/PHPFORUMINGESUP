<?php
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    /**/
    require 'include/basededonne.php';
    require_once 'include/fonction.php';
    $req = $db->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username'=> $_POST['email']]);
    $user = $req->fetch();
    if(password_verify($_POST['password'], $user->password)){
        session_start();
        $_SESSION['auth'] = $user;
        $_SESSION ['flash']['success']= "Vous etes maintenant connécté";
        header('Location: account.php');
        exit();
    }else{
        $_SESSION['flash']['danger']= 'Identificant ou mot de passe incorrect';
    }
}
?>


<?php require "include/header.php"; ?>

<h1>Mot de passe oublié</h1>

<form action="" method="POST">
    <div class="form-group">
        <label for="">Pseudo ou email</label>
        <input type="email" name="email" class="form-control"/>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
    <!--<input type="text" name="username" class ="form-control" required/> Pour forcer l'entrer des valeur-->
</form>

<?php require 'include/footer.php'; ?>
