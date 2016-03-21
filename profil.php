<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
//COOOKIEEEEEEEEEEEE
try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=espac_membre;charset=utf8', 'root', 'rootgio');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $pe) {
    echo $pe->getMessage();
}
/*verifier si la variable existe*/
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    /*Securisation de la varible entrer en nombre*/
    $getid = intval($_GET['id']);
    $requser = $db -> prepare('SELECT * FROM membre WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser -> fetch(); /*Pour cherche les info*/

    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>profil</title>
    </head>

    <body>
    <?php
    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
        echo "Profil de " . $userinfo['pseudo'];
        echo "Mail de " . $userinfo['mail'];
        ?>
        <a href="edition.php">Editer mon profil</a>
        <a href="deconnexion.php">Deco</a>
        <?php
    }
    ?>
    </body>
    </html>
    <?php
}
?>