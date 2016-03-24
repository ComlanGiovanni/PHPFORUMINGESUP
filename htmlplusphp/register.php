<?php
require 'include/header.php';
require_once 'include/fonction.php';
session_start();
if(!empty($_POST)) {

    $error = array();
    require 'include/basededonne.php';

    /*expersion regulier  compirs entre a et z et 0 et 9 et des underscore*/
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $error['username'] = "Votre pseudo n'est pa valide (explication reqref)";
    } else {
        $req = $db->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();/*recuperer le premier enregistrement*/
        if ($user) {
            $error['username'] = "ce nom d'utilisateur est déja utiliser";
        }
    }

    /* true si ou false non si ca ne valide pas on n'a l'erreur*/
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "votre email n'est pas valide";
    } else {
        $req = $db->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();/*recuperer le premier enregistrement*/
        if ($user) {
            $error['email'] = "ce mail est déja utiliser";
        }
    }

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $error['password'] = "Vos mot de passe ne correspond pas";
    }
    if (empty($error)) {
        $req = $db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        debug($token);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token ]);
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a éte envoyé';
        $user_id = $db->lastInsertId();
        /*
        mail($_POST['email'],'confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://127.0.0.1/forum2/confirm.php?=$user_id&token=token");
        header('Location: login.php');*/
        die('Votre compte a bien été crée   http://127.0.0.1/forum2/confirm.php?id=$user_id&token=$token  ');
    }

}

?>



    <h1>s'inscrire</h1>

<?php if(!empty($error)):?>

    <div class="alert alert-danger">
        <p>Vous n'avez pas remplis le formulaire correctement</p>
        <ul>
            <?php foreach($error as $err): ?>
                <li><?= $err; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="">Pseudo</label>
            <input type="text" name="username" class ="form-control"/>
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class ="form-control"/>
        </div>

        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="password" class ="form-control"/>
        </div>

        <div class="form-group">
            <label for="">Confirmer Mot de passe</label>
            <input type="password" name="password_confirm" class ="form-control"/>
        </div>

        <button type="submit" class="btn btn-primary">M'inscrire</button>
        <!--<input type="text" name="username" class ="form-control" required/> Pour forcer l'entrer des valeur-->
    </form>

<?php require 'include/footer.php'?>