<?php
require 'include/header.php';
require 'include/basededonne.php';
/*
$data = $db->query('SELECT * FROM posts');
var_dump($data->fetchAll());
*/

?>

<?php if(isset($_SESSION['auth'])): ?>
    <p>Poster un commentaire !</p>
<?php else: ?>
    <p>connecte vous pour publié un commentaire</p>
<?php endif; ?>

<?php require 'include/footer.php'?>
