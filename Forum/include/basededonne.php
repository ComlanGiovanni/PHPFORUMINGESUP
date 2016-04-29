<?php
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=espac_membre;charset=utf8', 'root', 'rootgio');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $pe) {
    echo $pe->getMessage();
}


/*
 *
 *Simple connexion a la base de donnée
 *
 */