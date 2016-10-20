<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 7-11-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player" ) {
	if(isset($_GET['lgame_id'])) {
		echo $idgame = $_GET['lgame_id'];
		echo $idmember = $_SESSION['user_id'];
		if ($stmtDeleteUserGame = $mysqli->prepare("DELETE FROM can_contains WHERE id_etsim_members = ? AND id_etsim_game = ? ;")) {
			$stmtDeleteUserGame->bind_param('ss', $idmember, $idgame);
			$stmtDeleteUserGame->execute();
			$stmtDeleteUserGame->close();
			if ($deleteplanthave = $mysqli->prepare("DELETE FROM have WHERE id_etsim_members_have = ? AND id_etsim_game = ?;")) {
				$deleteplanthave->bind_param('ss', $idmember, $idgame); 
				$deleteplanthave->execute();
				$deleteplanthave->close();
			} else {
				$error_msg .= "Error delete users and game to HAVE!";
			}
			if ($deleteroundtemp = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimmember_etsim_round_game_temp = ? AND idetsimgame_etsim_round_game_temp = ?;")) {
				$deleteroundtemp->bind_param('ss', $idmember, $idgame); 
				$deleteroundtemp->execute();
				$deleteroundtemp->close();
			} else {
				$error_msg .= "Error delete users and game to etsim_round_game_temp!";
			}
			if ($deleteround = $mysqli->prepare("DELETE FROM etsim_round_game WHERE id_etsim_round_game like ?;")) {
				$idR = $idgame.'-'.$idmember."%";
				$deleteround->bind_param('s', $idR); 
				$deleteround->execute();
				$deleteround->close();
			} else {
				$error_msg .= "Error delete users and game to etsim_round_game!";
			}
		} else {
			$error_msg .= "Error delete !";
		}
	} else {
		echo "FAUX";
	}
} 

?>