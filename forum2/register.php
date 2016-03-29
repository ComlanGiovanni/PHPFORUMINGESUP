<?php
require_once 'include/fonction.php';
session_start();

log_re();

if(!empty($_POST)) {

    $error = array();
    $pseudo = htmlspecialchars($_POST['username']);

    require 'include/basededonne.php';
    $pseudotaille =strlen($_POST['username']);

    if($pseudotaille <=50) {
        /*https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/memento-des-expressions-regulieres*/
        /*expersion regulier  compirs entre a et z et 0 et 9 et des underscore*/
        if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
            $error['username'] = "Votre pseudo n'est pa valide (a-z A-Z 0-9)";
        }else {
            $req = $db->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();/*recuperer le premier enregistrement*/
            if ($user) {
                $error['username'] = "ce nom d'utilisateur est déja utiliser";
            }
        }
    }else{
        $error['username'] = "Dépasse 50";
    }

    /* true si ou false non si ca ne valide pas on n'a l'erreur*/
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['emailconfirm']);

    if ($email == $email2) {

        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "votre email n'est pas valide";
        } else {
            $req = $db->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();/*recuperer le premier enregistrement*/
            if ($user) {
                $error['email'] = "Ce mail est déja utiliser";
            }
        }
    }else{
        $error['mail'] = "Les deux mails ne corresponde pas";
    }

    $mdpsec =strlen($_POST['password']);

    /*
    if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password']) && !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password_confirm'])) {
    }else{
        $error['password'] = "a-zA-Z0-9";
    }
    */

    if ($mdpsec > 8) {
        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $error['password'] = "Vos mot de passe ne correspond pas";
        }
    } else {
        $error['password'] = "Le mot de passe doit être faire au moins 9 caractére";
    }


    if (empty($error)) {
        $req = $db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token ]);
        $user_id = $db->lastInsertId();
        /*
                $message = "Afin de valider votre compte merci de cliquer sur ce lien \r\n http://127.0.0.1/forum2/confirm.php?id=$user_id&token=$token";
        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
                $message = wordwrap($message, 70, "\r\n");
                mail('$_POST[\'email\']', 'Valiation', $message);

        mail($_POST['email'],'confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://127.0.0.1/forum2/confirm.php?id=$user_id&token=$token");
        */
        $_SESSION['flash']['success']='Votre compte a bién été crée! un email de confirmation vous a été envoyé';
        header('Location: login.php');
        exit();
    }

}

?>

<?php require 'include/header.php';?>


    <div class="container">
        <h1>S'inscrire</h1>
        <a href="login.php">(Connexion)</a>
        <br>
        <br>
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
                <input required type="text" name="username" class ="form-control" value="<?= (!empty($pseudo))?$pseudo:'' ?>"/>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input required type="email" name="email" class ="form-control" value="<?= (!empty($email))?$email:'' ?>"/>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input required type="email" name="emailconfirm" class ="form-control" value="<?= (!empty($email2))?$email2:'' ?>"/>
            </div>

            <div class="form-group">
                <label for="">Mot de passe</label>
                <input required type="password" name="password" class ="form-control"/>
            </div>

            <div class="form-group">
                <label for="">Confirmer Mot de passe</label>
                <input required type="password" name="password_confirm" class ="form-control"/>
            </div>

            <button type="submit" class="btn btn-primary">M'inscrire</button>
        </form>
    </div>

<?php require 'include/footer.php'?>