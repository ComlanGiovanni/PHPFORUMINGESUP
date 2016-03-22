<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=espac_membre;charset=utf8', 'root', 'rootgio');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $pe) {
    echo $pe->getMessage();
}

if(isset($_POST['forminscription']))
{
    if(!empty($_POST['pseudo'] AND $_POST['email'] AND $_POST['email2'] AND $_POST['motdepasse'] AND $_POST['motdepasse2']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $email2 = htmlspecialchars($_POST['email2']);
        $mdp = sha1($_POST['motdepasse']);
        $mdp2 = sha1($_POST['motdepasse2']);

        $pseudotaille =strlen($pseudo);
        if($pseudotaille <=10)
        {
            $reqpseudo = $db->prepare("SELECT * FROM membre WHERE pseudo = ?");
            $reqpseudo -> execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();
            if($pseudoexist == 0) {
                if ($email == $email2) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $reqmail = $db->prepare("SELECT * FROM membre WHERE mail = ?");
                        $reqmail->execute(array($email));
                        $mailexist = $reqmail->rowCount();
                        if ($mailexist == 0) {
                            if ($mdp == $mdp2) {
                                $insertmbr = $db->prepare("INSERT INTO membre(pseudo, mail, motdepasse) VALUES (?, ?, ?) ");
                                $insertmbr->execute(array($pseudo, $email, $mdp));
                                $erreur = "Compte cree";
                            } else {
                                $erreur = "mdp non egale";
                            }
                        } else {
                            $erreur = "mail deja use";
                        }
                    } else {
                        $erreur = "Ceci n'est pas une adresse email";
                    }
                } else {
                    $erreur = "les mails ne correspondent pas";
                }
            }
            else{
                $erreur = "pseudo deja utilisé";
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser 10 lettre";
        }
    }

    else
    {
        $erreur="Tous les champs doivent etre completer";
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
    <form action="inscription.php" method='post'>
        <table>
            <tr>
                <td>
                    <label for="pseudo">Pseudo :</label>
                </td>
                <td><input type="text" name="pseudo" placeholder="Votre pseudo" id="pseudo" value="<?= (!empty($pseudo))?$pseudo:'' ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>
                    <input type='email' name='email' placeholder="Votre email" id="email" value="<?= (!empty($email))?$email:'' ?>"
                </td>
            </tr>
            <tr>
                <td><label for="emailconfirm">Confirmation du mail</label></td>
                <td>
                    <input type='email' name='email2' placeholder="Votre email" id="emailconfirm" value="<?= (!empty($email2))?$email2:'' ?>"
                </td>
            </tr>
            <tr>
                <td><label for="mdp">Mot de passe :</label></td>
                <td><input type="password" name='motdepasse' placeholder="Votre mot de passe" id="mdp"></td>
            </tr>
            <tr>
                <td><label for="mdp2">Mot de passe :</label></td>
                <td><input type="password" name='motdepasse2' placeholder="Votre mot de passe" id="mdp2"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="forminscription" value="Je m'inscris">
                </td>
            </tr>
        </table>
    </form>
    <a href="index.php">login</a>

    <?php
    if(isset($erreur))
    {
        echo $erreur;
    }
    ?>

</div>
</body>
</html>
