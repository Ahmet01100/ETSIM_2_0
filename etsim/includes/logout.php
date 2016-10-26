<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 15-10-2015
*/
include_once 'functions.php';
if(!isset($_SESSION))
    sec_session_start();
 
// Détruisez les variables de session 
$_SESSION = array();
 
// Retournez les paramètres de session 
$params = session_get_cookie_params();
 
// Effacez le cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Détruisez la session 
session_destroy();
header('Location: ../index.php');
exit;
?>