<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=espac_membre;charset=utf8', 'root', 'rootgio');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $pe) {
    echo $pe->getMessage();
}

if(isset($_SESSION['id'])) {
    $requser = $db->prepare('SELECT * FROM membre WHERE pseudo = ?');
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>prof</title>
    </head>

    <body>
    <div>
        <form action="" method='post'>
            <label>Pseudo:</label>
            <input type="text" name='newpseudo' placeholder="new pseudo" value="" <br/><br/><br/>
            <label>Mail</label>
            <input type="text" name='newmail' placeholder="new mail" value=""> <br/><br/>
            <label>Mot de passe</label>
            <input type="password" name='newmdp1' placeholder="new mdp"> <br/><br/>
            <label>Confirmation mdp</label>
            <input type="password" name='newmdp2' placeholder="confirm mdp"> <br/><br/>
            <input type="submit" value="Mettre a jour mon profil"> <br/><br/>
        </form>
    </div>
    </body>
    </html>
    <?php
}
else
{
    header("location:index.php");
}
?>