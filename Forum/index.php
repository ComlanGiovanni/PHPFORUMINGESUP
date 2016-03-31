<?php
require 'include/header.php';
require 'include/basededonne.php';
/*
$data = $db->query('SELECT * FROM posts');
var_dump($data->fetchAll());
*/

$slugsecu = 'mon-super-slug';

$q=$db->prepare('SELECT * FROM posts WHERE slug = :slug');
$q->execute(['slug' => $slugsecu]);
$post = $q->fetch();

?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-body">
            Sujet 1 :<a href="http://127.0.0.1/forum2/topic.php?p=posts.view&slug=mon-super-slug"><?= $post->name; ?></a>
        </div>
        <div class="panel-footer"><h2><?= $post->content; ?></h2></div>
    </div>
    <div class="panel panel-success">
        <div class="panel-body">
            Sujet 2
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-info"><div class="panel-body">
            Sujet 3
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-warning"><div class="panel-body">
            Sujet 4
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-danger"><div class="panel-body">
            Sujet 5
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-primary"><div class="panel-body">
            Sujet 6
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-success">
        <div class="panel-body">
            Sujet 7
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-info"><div class="panel-body">
            Sujet 8
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-warning"><div class="panel-body">
            Sujet 9
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-body">
            Sujet 10
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
</div>
<?php require 'include/footer.php'; ?>