<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 7-11-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	if(!isset($_SESSION))
        sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player" ) {
	if(isset($_GET['lgame_id'])) {
		echo $idgame = $_GET['lgame_id'];
		echo $idmember = $_SESSION['user_id'];
		if ($stmtDeleteUserGame = $mysqli->prepare("DELETE FROM can_contains WHERE id_etsim_members = :idMember AND id_etsim_game = :idGame ;")) {
			$stmtDeleteUserGame->bindParam(':idMember', $idmember);
            $stmtDeleteUserGame->bindParam(':idGame', $idgame);
			$stmtDeleteUserGame->execute();
			//$stmtDeleteUserGame->close();
			if ($deleteplanthave = $mysqli->prepare("DELETE FROM have WHERE id_etsim_members_have = :idEtsimMember AND id_etsim_game = :idEtsimGame;")) {
				$deleteplanthave->bindParam(':idEtsimMember', $idmember); 
                $deleteplanthave->bindParam(':idEtsimGame', $idgame);
				$deleteplanthave->execute();
				//$deleteplanthave->close();
			} else {
				$error_msg .= "Error delete users and game to HAVE!";
			}
			if ($deleteroundtemp = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimmember_etsim_round_game_temp = :idMemb AND idetsimgame_etsim_round_game_temp = :idRoundGame;")) {
				$deleteroundtemp->bindParam(':idMemb', $idmember); 
                $deleteroundtemp->bindParam(':idRoundGame', $idgame); 
				$deleteroundtemp->execute();
				//$deleteroundtemp->close();
			} else {
				$error_msg .= "Error delete users and game to etsim_round_game_temp!";
			}
			if ($deleteround = $mysqli->prepare("DELETE FROM etsim_round_game WHERE id_etsim_round_game like :idRound;")) {
				$idR = $idgame.'-'.$idmember."%";
				$deleteround->bindParam(':idRound', $idR); 
				$deleteround->execute();
				//$deleteround->close();
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