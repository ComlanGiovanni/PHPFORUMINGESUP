<?php require "include/header.php"; ?>
<?php require 'include/basededonne.php';?>
<?php require_once 'include/fonction.php';;?>

<?php
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    /*Securisation de la varible entrer en nombre*/
    /*$getid = intval($_GET['id']);*/
    $req = $db -> prepare('SELECT * FROM users WHERE id = ?');
    $req->execute([$_GET['id']]);
    $user = $req-> fetch();
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>profil</title>
    </head>
    <body>

    <div class="container">
        <?php
        echo $user->id;
        echo "<br>";
        echo "Date de création";
        echo $user->confirmed_at;
        echo "<br>";
        echo "Nom:";
        echo $user->username;
        echo "Nom:";
        echo "<br>";
        echo "Statut";
        echo "<br>";
        echo "Numéro de télephone";
        echo "<br>";
        echo "localisation";
        echo "<br>";
        echo "date d'anniversaire";
        echo "<br>";
        echo "Hommes ou femmes";
        echo "<br>";
        echo "age";
        echo "<br>";
        echo "nationalité";
        echo "<br>";
        echo "taille";
        echo "<br>";
        echo "religion";
        echo "<br>";
        echo "Courriel";
        echo "<br>";
        echo "lien";
        echo "<br>";
        echo "célibataire";
        echo "<br>";
        debug($user);
        ?>
    </div>

    </body>
    </html>
    <?php
}
?>

<?php require 'include/footer.php'; ?>