<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 7-11-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player") {
	if(isset($_GET['idGame']) && isset($_GET['idRound'])){	
		if ($SelectLimitDatetimeRound = $mysqli->prepare("SELECT datetime_round_etsim_game_round_datetime FROM etsim_game_round_datetime WHERE id_etsim_game = ? AND round_number_etsim_game_round_datetime = ?;")) {
				$SelectLimitDatetimeRound->bind_param('ss', $_GET['idGame'], $_GET['idRound']);  // Lie "$email" aux paramètres.
				$SelectLimitDatetimeRound->execute();    // Exécute la déclaration.
				$SelectLimitDatetimeRound->store_result();
				$SelectLimitDatetimeRound->bind_result($dateEndRound);
				$SelectLimitDatetimeRound->fetch();
				$today = date("Y-m-d H:i:s");
				echo $dteDiff  = $today->diff($dateEndRound);
				return $dteDiff;
			}
		$SelectLimitDatetimeRound->close();
	}
	
	if(isset($_GET['game_id']) && isset($_GET['user_id']) && isset($_GET['round_number']) && isset($_GET['line_number']) && isset($_GET['demand'])){
		$idG = $_GET['game_id'];
		$idU = $_GET['user_id'];
		$idRN = $_GET['round_number'];
		$idLR = $_GET['line_number'];
		$demand = $_GET['demand'];
		$SelectCountNumber = "SELECT id_etsim_plant_game_contains FROM can_contains WHERE id_etsim_game = ? AND id_etsim_members = ? GROUP BY id_etsim_round_game ORDER BY id_etsim_round_game DESC limit 1;";
		if( $stmtSelectCountNumber = $mysqli->prepare($SelectCountNumber) ) {
            $stmtSelectCountNumber->bind_param('ss', $idG, $idU);
			$stmtSelectCountNumber->execute();
			$stmtSelectCountNumber->store_result();
			$stmtSelectCountNumber->bind_result($id_etsim);
			$stmtSelectCountNumber->fetch();
			$stmtSelectCountNumber->close();
		}
		$insertRound = "INSERT INTO etsim_round_game_temp ( `idetsimgame_etsim_round_game_temp`, 
															`idetsimmember_etsim_round_game_temp`, 
															`number_etsim_round_game_temp`, 
															`line_etsim_round_game_temp`, 
															`bid_volume_etsim_round_game_temp`, 
															`bid_price_etsim_round_game_temp`, 
															`demand_voume_etsim_round_game_temp`, 
															`market_price_etsim_round_game_temp`, 
															`income_etsim_round_game_temp`, 
															`cost_etsim_round_game_temp`, 
															`benefit_etsim_round_game_temp`, 
															`capital_etsim_round_game_temp`,
															`idplant_etsim_round_game_temp`,
															`finnish_etsim_round_game_temp`) 
						VALUES (?, ?, ?, ?, 1, 1, ?, 1, 1, 1, 1, 1, ?, 0);";
		if( $stmtinsertRound = $mysqli->prepare($insertRound) ) {
			$stmtinsertRound->bind_param('ssssss', $idG, $idU, $idRN, $idLR, $demand, $id_etsim);
			$stmtinsertRound->execute();
		} else {
			$error_msg .= 'Error insert new rows !';
		}
		return true;
	}

	if(isset($_GET['Dgame_id']) && isset($_GET['Duser_id']) && isset($_GET['Dround_number']) && isset($_GET['Dline_number'])){
		$idG = $_GET['Dgame_id'];
		$idU = $_GET['Duser_id'];
		$idRN = $_GET['Dround_number'];
		$idLR = $_GET['Dline_number'];
		$deleteLine = "DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = ? AND idetsimmember_etsim_round_game_temp = ? AND number_etsim_round_game_temp = ? AND line_etsim_round_game_temp = ?;";
		if( $sqldeleteLine = $mysqli->prepare($deleteLine) ) {
			$sqldeleteLine->bind_param('ssss', $idG, $idU, $idRN, $idLR);
			$sqldeleteLine->execute();
		} else {
			$error_msg .= 'Error insert new rows !';
		}
	}
	
	if(isset($_GET['Uval']) && isset($_GET['Ucol']) && isset($_GET['Ugame_id']) && isset($_GET['Uuser_id']) && isset($_GET['Uround_number']) && isset($_GET['Uline_number'])){
		if ($updatelineroundgame = $mysqli->prepare("UPDATE etsim_round_game_temp SET ".$_GET['Ucol']." = \"".$_GET['Uval']."\" WHERE idetsimgame_etsim_round_game_temp = ".$_GET['Ugame_id']." AND idetsimmember_etsim_round_game_temp = ".$_GET['Uuser_id']." AND number_etsim_round_game_temp = ".$_GET['Uround_number']." AND line_etsim_round_game_temp = ".$_GET['Uline_number'].";")) {
			$updatelineroundgame->execute();    // Exécute la déclaration.
		} else {
			$error_msg .= "erreur";
		}
		$updatelineroundgame->close();
	}
	
	if(isset($_GET['LUval']) && isset($_GET['LUcol']) && isset($_GET['LUgame_id']) && isset($_GET['LUuser_id']) && isset($_GET['LUround_number']) && isset($_GET['LUline_number'])){
		if ($updatelineroundgame = $mysqli->prepare("UPDATE etsim_round_game_temp SET ".$_GET['LUcol']." = \"".$_GET['LUval']."\" WHERE idetsimgame_etsim_round_game_temp = ".$_GET['LUgame_id']." AND idetsimmember_etsim_round_game_temp = ".$_GET['LUuser_id']." AND number_etsim_round_game_temp = ".$_GET['LUround_number']." AND line_etsim_round_game_temp = ".$_GET['LUline_number'].";")) {
			$updatelineroundgame->execute();    // Exécute la déclaration.
		} else {
			$error_msg .= "erreur";
		}
		$updatelineroundgame->close();
	}
	
	if(isset($_GET['Cgame_id']) && isset($_GET['Cuser_id']) && isset($_GET['Cround_number'])) {
		$idGame = $_GET['Cgame_id'];
		$roundGame = $_GET['Cround_number'];
		if ($updateApplyRoundGameForUser = $mysqli->prepare("UPDATE etsim_round_game_temp SET finnish_etsim_round_game_temp = 1 WHERE idetsimgame_etsim_round_game_temp = ? AND number_etsim_round_game_temp = ? AND idetsimmember_etsim_round_game_temp = ?;")) {
			$updateApplyRoundGameForUser->bind_param('sss', $idGame, $roundGame, $_SESSION[user_id]);
			$updateApplyRoundGameForUser->execute();  
			$updateApplyRoundGameForUser->close();
		}
	}
	
	if(isset($_GET['Mgame_id']) && isset($_GET['Mround_number'])) {
		$idGame = $_GET['Mgame_id'];
		$idRound = $_GET['Mround_number'];
		if ($SelectRoundTemp = $mysqli->prepare("SELECT * FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = ? AND number_etsim_round_game_temp = ?;")) {
			$SelectRoundTemp->bind_param('ss', $idGame, $idRound);
			$SelectRoundTemp->execute();
			$resultSelectRoundTemp = $SelectRoundTemp->get_result();
			while($rowresultSelectRoundTemp = $resultSelectRoundTemp->fetch_assoc()) {
				$id = $rowresultSelectRoundTemp['idetsimgame_etsim_round_game_temp'].$rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp'].$rowresultSelectRoundTemp['number_etsim_round_game_temp'].$rowresultSelectRoundTemp['line_etsim_round_game_temp'];
				if ($insertResults = $mysqli->prepare("REPLACE INTO etsim_round_game VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {
					$insertResults->bind_param('ssssssssss', $id, $idRound, $rowresultSelectRoundTemp['bid_volume_etsim_round_game_temp'], $rowresultSelectRoundTemp['bid_price_etsim_round_game_temp'], $rowresultSelectRoundTemp['demand_voume_etsim_round_game_temp'], $rowresultSelectRoundTemp['market_price_etsim_round_game_temp'], $rowresultSelectRoundTemp['income_etsim_round_game_temp'], $rowresultSelectRoundTemp['cost_etsim_round_game_temp'], $rowresultSelectRoundTemp['benefit_etsim_round_game_temp'], $rowresultSelectRoundTemp['capital_etsim_round_game_temp']);
					$insertResults->execute();
					$insertResults->close();						
				}
				if ($SelectCanContains = $mysqli->prepare("SELECT * FROM can_contains WHERE id_etsim_game = ? AND id_etsim_members = ? GROUP BY id_etsim_plant_game_contains ORDER BY id_etsim_plant_game_contains;")) {
					$SelectCanContains->bind_param('ss', $idGame, $rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp']);
					$SelectCanContains->execute();
					$resultSelectCanContains = $SelectCanContains->get_result();
					while($rowresultSelectCanContains = $resultSelectCanContains->fetch_assoc()) {
						if ($InsertIntoCanContains = $mysqli->prepare("INSERT INTO can_contains (id_etsim_plant_game_contains, id_etsim_game, id_etsim_members, id_etsim_round_game) VALUES (?, ?, ?, ?);")) {
							$InsertIntoCanContains->bind_param('ssss', $rowresultSelectCanContains['id_etsim_plant_game_contains'], $idGame, $rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp'], $id);
							$InsertIntoCanContains->execute();
							$InsertIntoCanContains->close();
						}
					}
				}
			}
			if ($DeleteGameFromTempRound = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = ?;")) {
				$DeleteGameFromTempRound->bind_param('s', $idGame);
				$DeleteGameFromTempRound->execute();
				$DeleteGameFromTempRound->close();
			}
		}
		$SelectRoundTemp->close();
	}
}
?>