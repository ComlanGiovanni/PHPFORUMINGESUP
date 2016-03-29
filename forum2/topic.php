<?php require 'include/header.php';?>
<?php require 'include/basededonne.php';?>

<?php
define('DS', DIRECTORY_SEPARATOR);
define('VIEWS', __DIR__ . DS . 'views'. DS);
define('ELEMENT', __DIR__ . DS . 'views'. DS . 'elements' . DS);
/*
var_dump(__DIR__);
*/
spl_autoload_register('autoload');
function autoload($class){
    /*
     * var_dump($class);
     * die();
     *
     * */
    require 'class' . DS . str_replace('\\', DS, $class). '.php';
}

if(!isset($_GET['p'])){
    $_GET['p'] = 'home';
}

$getsec = htmlspecialchars($_GET['p']);

if(preg_match('/^[a-z-0-9-A-Z]+\.?+$/', $_GET['p'])){
    $page = 'views/errors/404';
}else{
    $page = implode('/', explode( '.', $getsec));
}


if(file_exists('views/'. $page .'.php')){
    ob_start();

    try {
        require 'views/' . $page .'.php';
    } catch (Exception $q) {
        require 'views/errors/404.php';
    }

    $content = ob_get_clean();
}else{
    ob_start();
    require 'views/errors/404.php';
    $content = ob_get_clean();
}

require 'views/layouts/default.php';
?>



<?php require 'include/footer.php'?>