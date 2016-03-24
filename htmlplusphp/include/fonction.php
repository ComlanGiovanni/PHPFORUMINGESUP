<?php
/*Fonction de debug*/
function debug ($variable){

    echo '<pre>' . print_r($variable, true) .'</pre>';
}

/*
cette fonction melange et repete lalphabet par 60 et fait un substring de 0 e 60
*/

function str_random($length){

    $alphabet ="0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0,$length);

}


function log_only(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if (!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = "pas le droit";
        header('Location:login.php');
        exit();
    }
}