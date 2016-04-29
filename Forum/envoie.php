<?php
dem_session();
/*
 * session_start();
*/
require 'include/basededonne.php';
if(isset($_POST['envoiemessage'])){
    if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])){
        $destinataire = htmlspecialchars($_POST['destinataire']);
        $message = htmlspecialchars($_POST['message']);
        $id_destinataire = $db->prepare('SELECT id FROM users WHERE username = ?');
        $id_destinataire->execute(array($destinataire));
        $id_destinataire = $id_destinataire->fetch();
        var_dump($id_destinataire);
        $id_destinataire = $id_destinataire['id'];
        var_dump($id_destinataire);
    }else{
        $error = "tous les champs";
    }



}

$destinataires = $db->query('SELECT username FROM users ORDER BY username')

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Envoie de message</title>
    </head>
    <body>
       <label for="">Destinataire</label>
        <form action="" method="post">
            <select name="destinataire" id="">
                <?php while ($d = $destinataires->fetch()){?>
                <option><?= $d->username?></option>
                <?php } ?>
            </select>
            <br>
            <br>
            <textarea name="message" id="" cols="30" rows="10" placeholder="Votre message"></textarea>
            <br>
            <br>
            <input type="submit" value="Envoyer" name="envoiemessage"/>
            <br>
            <br>
            <?php if(isset($error)) {echo '<span style="color:red">'.$error.'<span>';} ?>
        </form>
    </body>
</html>