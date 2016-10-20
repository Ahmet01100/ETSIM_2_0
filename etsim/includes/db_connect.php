<?php
/*
* Created by : bryan.maisano@gmail.com
* DB connection file 
* date * 05-10-2015
*/
include_once 'psl-config.php';


try{
	$mysqli = new PDO ('mysql:host='.HOST.';dbname='.DATABASE, USER,PASSWORD);
    $mysqli->exec("SET CHARACTER SET utf8");
	}
catch (PDOException $e)
{
	echo $e->getMessage();
}
    /*$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if ($mysqli->connect_errno) {
		echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}*/
?>