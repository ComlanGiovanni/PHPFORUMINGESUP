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
        $_SESSION['flash2']['danger'] = "pas le droit veuillez vous connécté";
        header('Location:login.php');
        exit();
    }
}

function log_re(){
    if(isset($_SESSION['auth'])){
        header('Location: account.php');
        exit();
    }
}

function cookie_token(){

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_COOKIE['cookie']) && !isset($_SESSION['auth'])){
        require_once 'basededonne.php';
        if(!isset($db)){
            global $db;
        }
        $cookie_token = $_COOKIE['cookie'];
        $parts = explode('==',$cookie_token);
        $user_id = $parts[0];
        $req = $db->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if($user){
            $expected = $user_id. '==' . $user->cookie_token . sha1($user_id . 'pffaucuneeideedecle');
            if($expected == $cookie_token){
                session_start();
                unset($_SESSION['flash2']);
                $_SESSION ['flash']['success']= "Vous etes maintenant connécté";
                $_SESSION['auth'] = $user;
                setcookie('cookie', $cookie_token, time() + 60 * 60 * 24 * 7);
            }else{
                setcookie('cookie', NULL, -1);
            }
        }else{
            setcookie('cookie', NULL, -1);
        }
    }
}