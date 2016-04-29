<?php

if(isset($_GET['id']) && isset($_GET['token'])){
    require 'include/basededonne.php';
    $req = $db->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();

    if($user){
        if(!empty($_POST)) {
            if (!empty($_POST['password']) && $_POST['password_confirm']) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $db->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = "Le mot de passe a été modfié";
                $_SESSION['auth'] = $user;
                header('Location: account.php');
                exit();
            }
        }

    }else{
        session_start();
        $_SESSION['flash']['danger']="ce lien n'est pas valide";
        header('Location: login.php');
        exit();

    }
}else{
    header('Location: login.php');
    exit();
}
?>



<?php require "include/header.php"; ?>
    <div class="container">
        <h1>modifié votre mot de passe!</h1>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nvmpd">Nouveau mot de passe</label>
                <input type="password" id="nvmpd" name="password" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="nvmpdconf">Confirmation de mot de passe</label>
                <input type="password" id="nvmpdconf" name="password_confirm" class="form-control"/>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
            <!--<input type="text" name="username" class ="form-control" required/> Pour forcer l'entrer des valeur-->
        </form>
    </div>
<?php require 'include/footer.php'; ?>