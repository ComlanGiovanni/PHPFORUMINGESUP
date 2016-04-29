<?php
require 'include/basededonne.php';
require 'include/fonction.php';

$user_id = $_GET['id'];
$token = $_GET['token'];
/*
 * recuperationdes parametres
 * entrer dans le lien
 * */
$req = $db-> prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();

dem_session();

/*
 *session_start();
 */

if($user && $user->confirmation_token == $token){
    $db-> prepare('UPDATE users SET confirmation_token =NULL, confirmed_at= NOW() WHERE id= ?')-> execute([$user_id]);
    $_SESSION['auth'] = $user;
    $_SESSION['flash']['success']="Votre compte viens d'être validé!!";
    header("Location: account.php");
}else{
    $_SESSION['flash2']['danger']="Ce lien n'est plus valid";
    header('Location:login.php');
}

/*
 * verifier si le token et l'utilisateur correspond (on peux utiliser un talo)
 *si le token est bon
 * on mets a jours dans users le confirtoken a NULL
 * et on met le confirmat a la date NOW (MYSQL)
 * ET ON MET A JOUR QU'A L'ENDROIT DE L'ID
 *
 */