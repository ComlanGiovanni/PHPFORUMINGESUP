<div class="row" style="border: solid 1px #b60c35">
    <div class="col-xs-2">
        <img src="/forum2/avatar/domo.jpg" width="100%">
        <!--https://fr.gravatar.com/avatar/-->
    </div>
    <div class="col-xs-10">
        <p><a href="/forum2/profil.php?id=60"><?= $comment->username ;?></a>,<?=date('d/m/Y', strtotime($comment->created)); ?></p>
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