<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 12-10-2015
*/
include 'db_connect.php';
include 'functions.php';
 
if(!isset($_SESSION))
    sec_session_start(); // Notre façon personnalisée de démarrer la session PHP
if (isset($_POST['formlogin']) && $_POST['formlogin'] == 'formlogin') {
	 if (isset($_POST['login'], $_POST['password'])) {
		$login = $_POST['login'];
		$password = $_POST['password']; // Le mot de passe hashé.
	 
		if (login($login, $password, $mysqli) == true) {
			// Connecté 
			header('Location: ../index.php');
		} else {
			// Pas connecté 
			header('Location: ../index.php?error=1');
		}
	} else {
		// Les variables POST correctes n’ont pas été envoyées à cette page
		echo 'Invalid Request';
	}
}
?>