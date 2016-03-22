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

if(isset($_POST['formconnect'])){
    $pseudoconnect =htmlentities($_POST['identifiant']);
    $mdpconnect = sha1($_POST['motdepasse']);
    if(!empty($pseudoconnect) AND !empty($mdpconnect))
    {
        $requetuser = $db->prepare("SELECT * FROM membre WHERE pseudo = ? AND motdepasse = ?");
        $requetuser -> execute(array($pseudoconnect,$mdpconnect));
        $existuser= $requetuser -> rowCount();
        if($existuser == 1)
        {
            /*
            $userinfo = $requetuser -> fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location:profil.php?id=".$_SESSION['id']);
            */
            $_SESSION['id'] = $_POST['identifiant'];
            header('Location:forum.php');
        }
        else
        {
            $erreur ="mauvais pseaudo ou mdp";
        }
    }
    else
    {
        $erreur= "Remplir tous cahmps complet !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
    </head>

    <body>
        <div>
            <form action="" method='post'> 
                <table> 
                    <tr>
                        <td><label for="pseudo">Pseudo :</label></td>
                        <td><input type="text" name='identifiant' placeholder="Votre pseudo" id="pseudo"></td>
                    </tr>
                    <tr>
                        <td><label for="mdp">Mot de passe :</label></td>
                        <td><input type="password" name='motdepasse' placeholder="Votre mot de passe" id="mdp"></td>
                    </tr>
                    <tr>
                        <td><input type='submit' name="formconnect" value='Envoyer'></td>
                    </tr>
                </table>
                <a href="inscription.php"> Insctiption</a>
            </form>
            <?php
            if(isset($erreur))
            {
                echo $erreur;
            }
            ?>
        </div>
    </body>
</html>