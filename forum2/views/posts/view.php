<?php

if(empty($_GET['slug'])){
    throw  new Exception('404');
}

$slugsecu = htmlspecialchars($_GET['slug']);

$q=$db->prepare('SELECT * FROM posts WHERE slug = :slug');
$q->execute(['slug' => $slugsecu]);
$post = $q->fetch();

if(!$post){
    throw  new Exception('404');
}

use Giovanni\plugin\Comments;
$comments_cls = new  Comments($db);
$errors = false;
$success = false;
if(isset($_POST['action']) && $_POST['action'] == 'comment'){
    $save = $comments_cls->save('posts', $post->id);
    if($save){
        $success = true;
    }else{
        $errors = $comments_cls->errors;

    }
}
$comments = $comments_cls->findAll('posts', $post->id);

/*
$com = $db->query("SELECT * FROM comments WHERE ref_id = {$post->id} AND ref='posts' ORDER BY created DESC");
$comments = $com->fetchAll();
*/
?>

<h1><?= $post->name; ?></h1>
<h2><?= $post->content; ?></h2>

<h3><?= count($comments); ?> commentaire</h3>

<!--
Pour chaque commentaire on lui applique l'element qui se trouve dans comment.php
-->
<?php foreach($comments as $comment): ?>
    <?php require ELEMENT. 'comment.php';?>
<?php endforeach;?>

<?php if($errors): ?>
    <div class="alert alert-danger">
        <strong>Impossible de poster le commentaire</strong>
        <ul>
            <?php foreach($errors as $error):?>
                <li><?= $error; ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php if($success): ?>
    <div class="alert alert-success">
        <strong>Commentaire bien envoyé</strong>
    </div>
<?php endif ?>

<?php if(isset($_SESSION['auth'])): ?>
    <form action="#comment" role="form" method="post" id="comment">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="comcom">Commentaire</label>
                    <textarea name="content" id="comcom" class="form-control"></textarea>
                </div>

                <button name="action" value="comment" type="submit" class="btn btn-primary">Envoyer</button>
            </div>
    </form>
<?php else: ?>
    <h3>Connecé vous pour laissé un commentaire</h3>
<?php endif; ?>

<!--
<div class="col-xs-6">
    <div class="form-group">
        <label for="pseudocom">Pseudo</label>
        <input type="text" id="pseudocom" class="form-control" name="usernamecom"/>
    </div>
</div>

<div class="col-xs-6">
    <div class="form-group">
        <label for="mailcom">Email</label>
        <input type="text" id="mailcom" class="form-control" name="emailcom"/>
    </div>
</div>
-->
</div>
