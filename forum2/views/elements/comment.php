<link rel="stylesheet" href="/forum2/css/boostrapcyborg.css">
<div class="row" style="border: solid 1px #b60c35">
    <div class="col-xs-2">
        <img src="/forum2/avatar/domo.jpg" width="100%">

        <!--https://fr.gravatar.com/avatar/-->
        <!--
        PS: ça devients un peu compliqué
        Il vas valoir recuperer dans une valeur le nom de la personne qui a commenté
        et ensuite le comparé avec le nom de la personne qui est connecté (varible dans la session)
        et faire une condition qui ferras que si le nom d'utilisateur correspond alors on
        affiche l'image (possibilité d'affiché)
        <img src="/forum2/avatar/glyphicons-17-bin.png">
        dans l'image on mets donc une requête qui ferras supprimé le poste en question


        de modifié un post
        on vas faire la même condition pour la suppresion d'un poste et si on n'a bon
        on ferras un update du champs content
        possibilité 1
            on récupére le contenue du post et on l'affiche dans le text area
        possibilité
                Enfaite je n'ai pas d'autres idée

          sécurisation de la faille CRSF https://www.grafikart.fr/tutoriels/php/faille-csrf-155
          https://openclassrooms.com/courses/securisation-des-failles-csrf
        -->
    </div>
    <div class="col-xs-10">
        <p><a href="/forum2/profil.php?id=68"><?= $comment->username ;?></a>,<?=date('Y-m-d H:i:s', strtotime($comment->created)); ?></p>
        <p></p>
        <p><?= $comment->content ;?></p>
    </div>
</div>
<br>

<?php
/*
 *<?= md5($comment->email)?>
 */
?>