<?php require "include/header.php"; ?>
<?php require 'include/basededonne.php';?>

<?php
if(isset($_GET['username']) AND $_GET['username'])
{
    /*Securisation de la varible entrer en nombre*/
    /*$getid = intval($_GET['id']);*/
    $req = $db -> prepare('SELECT * FROM users WHERE username = ?');
    $req->execute([$_GET['username']]);
    $user = $req-> fetch();
    require_once 'include/fonction.php';
    debug($user);

    echo $user->id;
    echo "<br>";
    echo $user->confirmed_at;
    echo "<br>";
    echo $user->username;


    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>profil</title>
    </head>

    <body>

    <p>Statut Numéro de télephone localisation date d'anniversaire Hommes ou femmes age nationalité taille religieuses Courriel</p>
    <p>statu célibataire mettre un lien</p>

    </body>
    </html>
    <?php
}
?>

<?php require 'include/footer.php'; ?>