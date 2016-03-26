<?php require 'include/header.php';?>
<?php echo "coucou" ?>
<?php if(isset($_SESSION['auth'])): ?>
    <p>publié un truc</p>
<?php else: ?>
    <p>connecte vous pour publié</p>
<?php endif; ?>
<?php require 'include/footer.php'?>