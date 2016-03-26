<?php
require_once 'include/fonction.php';

cookie_token();

log_re();

$pseudo = htmlspecialchars($_POST['username']);

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once 'include/basededonne.php';
    $req = $db->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    /*
    $usernamesec = htmlspecialchars($_POST['username']);
    $usernamesec = htmlspecialchars($_POST['password']);
    */
    if(password_verify($_POST['password'], $user->password)){
        session_start();
        $_SESSION['auth'] = $user;
        $_SESSION ['flash']['success']= "Vous etes maintenant connécté";
        if($_POST['remember']){
            $cookie_token = str_random(250);
            $db->prepare('UPDATE users SET cookie_token = ? WHERE id = ?')->execute([$cookie_token, $user->id]);
            setcookie('cookie', $user->id . '==' . $cookie_token . sha1($user->id .'pffaucuneeideedecle'), time() + 60 * 60 * 24 *7);
        }
        header('Location: account.php');
        exit();
    }else{
        $_SESSION['flash']['danger']= 'Identificant ou mot de passe incorrect';
    }
}else{
    $_SESSION['flash']['danger']= 'Remplir tous cahmps complet !';
}
?>


<?php require "include/header.php"; ?>

<h1>se co</h1>

<form action="" method="POST">
    <div class="form-group">
        <label for="">Pseudo ou email</label>
        <input type="text" name="username" class="form-control" value="<?= (!empty($pseudo))?$pseudo:'' ?>"/>
    </div>

    <div class="form-group">
        <label for="">Mot de passe <a href="forget.php">(Mot de passe oublié)</a></label>
        <input type="password" name="password" class="form-control"/>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember" value="1"> Se seouvenir de moi
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
    <!--<input type="text" name="username" class ="form-control" required/> Pour forcer l'entrer des valeur-->
</form>

<?php require 'include/footer.php'; ?>
