<?php
/*
* Created by : bryan.maisano@gmail.com
* DB connection file 
* date * 05-10-2015
*/
include_once 'psl-config.php';

    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if ($mysqli->connect_errno) {
		echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>