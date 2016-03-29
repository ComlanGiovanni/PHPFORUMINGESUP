<?php
require 'include/fonction.php';
require_once 'include/basededonne.php';

log_only();

/*
 * si post n'existe pas et qu'il est vide
 * non
 * sinon
 * bad
 *
 * readonly
 * information vue par tout le monde
 * avatar pero
 *
 * */

if(!empty($_POST)){
    $errormodif = array();
    /*
     * $mdp = htmlspecialchars($_POST['password_anc']);
     *Toujours la meme question pour le verification du mot de passe avec password_verify
     */
    $mdpmodifn = htmlspecialchars($_POST['password']);
    $mdpmodifn2 = htmlspecialchars($_POST['password_confirm']);
    $mdptaille = strlen($_POST['password']);

    $reqq = $db->prepare('SELECT * FROM users WHERE id = :id');
    $reqq ->execute(['id' => $_SESSION['auth']->id]);
    $userr = $reqq->fetch();

    if(password_verify($_POST['password_anc'],$userr->password)){
        if($mdptaille > 8){
            $mdpsec2 =strlen($_POST['password']);
            if ($_POST['password'] != $_POST['password_confirm']){
                $_SESSION['flash']['danger'] = "Les mot de passes ne correspondent pas";
            }else if ($_POST['password'] = $_POST['password_confirm']){
                $user_id = $_SESSION['auth']->id;
                $passwordnew = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $db->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$passwordnew, $user_id]);
                $_SESSION['flash']['success'] = "Le mot de passe a été mise a jour";
            }

        }else{
            $errormodif['password'] = "Le mot de passe doit faire au moins 9 caractére";
        }
    }else{
        $errormodif['ancienpassword'] = "L'ancien mot de passe ne corrspond pas";
    }
}

require "include/headerparm.php";
?>

<!--

Possibilité de changer le pseudo le mail etc...
Nom Statut Numéro de télephonelocalisation date d'anniversaire
Hommes ou femmes age nationalité taille religion Courriel lien célibataire"

Information vue par tout le monde
Information qu'il est possible de modifié

-->

<?php if(!empty($errormodif)):?>
    <div class="container">
        <div class="alert alert-danger">
            <p>Vous n'avez pas remplis le formulaire correctement</p>
            <ul>
                <?php foreach($errormodif as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php endif; ?>

<div class="container">
    <h1>Bonjour <?= $_SESSION['auth']->username?></h1>
    <form action="" method="post">
        <label for="Ancienmdp">Ancien mot de passe</label>
        <div class="form-group">
            <input class ="form-control" id="Ancienmdp" type="password" name="password_anc" placeholder="Ancien mot de passe"/>
        </div>

        <label for="newmdp">Nouveau mot de passe</label>
        <div class="form-group">
            <input class ="form-control" id="newmdp" type="password" name="password" placeholder="Changer de mot de passe"/>
        </div>

        <label for="confirmnewmdp">Confirmation du nouveau mot de passe</label>
        <div class="form-group">
            <input class="form-control" id="confirmnewmdp" type="password" name="password_confirm" placeholder="Confrimation du mot de passe">
        </div>
        <button class="btn btn-primary">Changer mot de passe</button>
    </form>
</div>

<?php require 'include/footer.php'; ?>
