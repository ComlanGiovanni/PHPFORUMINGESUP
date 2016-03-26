<?php
require_once 'include/fonction.php';

log_only();

require 'include/header.php';
?>

<h1>Bonjour <?= $_SESSION['auth']->username ?></h1>
<h1>Mail: <?= $_SESSION['auth']->email ?></h1>
<h1>Date de validation <?= $_SESSION['auth']->confirmed_at ?></h1>
<!--readonly-->

<?php require 'include/footer.php'; ?>
