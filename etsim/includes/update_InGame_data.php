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

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player") {
	if(isset($_GET['idGame']) && isset($_GET['idRound'])){	
		if ($SelectLimitDatetimeRound = $mysqli->prepare("SELECT datetime_round_etsim_game_round_datetime FROM etsim_game_round_datetime WHERE id_etsim_game = :idGame AND round_number_etsim_game_round_datetime = :idRound;")) {
				$SelectLimitDatetimeRound->bindParam(':idGame', $_GET['idGame']); 
                $SelectLimitDatetimeRound->bindParam(':idRound', $_GET['idRound']); 
				$SelectLimitDatetimeRound->execute();    // Exécute la déclaration.
				//$SelectLimitDatetimeRound->store_result();
				$SelectLimitDatetimeRound->bindColumn('datetime_round_etsim_game_round_datetime',$dateEndRound);
				$SelectLimitDatetimeRound->fetch();
				$today = date("Y-m-d H:i:s");
				echo $dteDiff  = $today->diff($dateEndRound);
				return $dteDiff;
			}
		//$SelectLimitDatetimeRound->close();
	}
	
	if(isset($_GET['game_id']) && isset($_GET['user_id']) && isset($_GET['round_number']) && isset($_GET['line_number']) && isset($_GET['demand'])){
		$idG = $_GET['game_id'];
		$idU = $_GET['user_id'];
		$idRN = $_GET['round_number'];
		$idLR = $_GET['line_number'];
		$demand = $_GET['demand'];
		$SelectCountNumber = "SELECT id_etsim_plant_game_contains FROM can_contains WHERE id_etsim_game = :idGame AND id_etsim_members = :idMember GROUP BY id_etsim_round_game ORDER BY id_etsim_round_game DESC limit 1;";
		if( $stmtSelectCountNumber = $mysqli->prepare($SelectCountNumber) ) {
            $stmtSelectCountNumber->bindParam(':idGame', $idG);
            $stmtSelectCountNumber->bindParam(':idMember', $idU);
			$stmtSelectCountNumber->execute();
			//$stmtSelectCountNumber->store_result();
			$stmtSelectCountNumber->bindColumn('id_etsim_plant_game_contains',$id_etsim);
			$stmtSelectCountNumber->fetch();
			//$stmtSelectCountNumber->close();
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
						VALUES (:idGame, :idMember, :numberRound, :lineRound, 1, 1, :demandeVolume, 1, 1, 1, 1, 1, :idPlant, 0);";
		if( $stmtinsertRound = $mysqli->prepare($insertRound) ) {
			$stmtinsertRound->bindParam(':idGame', $idG);
            $stmtinsertRound->bindParam(':idMember', $idU);
            $stmtinsertRound->bindParam(':numberRound', $idRN);
            $stmtinsertRound->bindParam(':lineRound', $idLR);
            $stmtinsertRound->bindParam(':demandeVolume', $demand);
            $stmtinsertRound->bindParam(':idPlant', $id_etsim);
            
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
		$deleteLine = "DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idRound AND idetsimmember_etsim_round_game_temp = :idMember AND number_etsim_round_game_temp = :nbRound AND line_etsim_round_game_temp = :lineRound;";
		if( $sqldeleteLine = $mysqli->prepare($deleteLine) ) {
			$sqldeleteLine->bindParam(':idRound', $idG);
            $sqldeleteLine->bindParam(':idMember', $idU);
            $sqldeleteLine->bindParam(':nbRound', $idRN);
            $sqldeleteLine->bindParam(':lineRound', $idLR);
            //$sqldeleteLine->bind_param('ssss', $idG, $idU, $idRN, $idLR);
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
		//$updatelineroundgame->close();
	}
	
	if(isset($_GET['LUval']) && isset($_GET['LUcol']) && isset($_GET['LUgame_id']) && isset($_GET['LUuser_id']) && isset($_GET['LUround_number']) && isset($_GET['LUline_number'])){
		if ($updatelineroundgame = $mysqli->prepare("UPDATE etsim_round_game_temp SET ".$_GET['LUcol']." = \"".$_GET['LUval']."\" WHERE idetsimgame_etsim_round_game_temp = ".$_GET['LUgame_id']." AND idetsimmember_etsim_round_game_temp = ".$_GET['LUuser_id']." AND number_etsim_round_game_temp = ".$_GET['LUround_number']." AND line_etsim_round_game_temp = ".$_GET['LUline_number'].";")) {
			$updatelineroundgame->execute();    // Exécute la déclaration.
		} else {
			$error_msg .= "erreur";
		}
		//$updatelineroundgame->close();
	}
	
	if(isset($_GET['Cgame_id']) && isset($_GET['Cuser_id']) && isset($_GET['Cround_number'])) {
		$idGame = $_GET['Cgame_id'];
		$roundGame = $_GET['Cround_number'];
		if ($updateApplyRoundGameForUser = $mysqli->prepare("UPDATE etsim_round_game_temp SET finnish_etsim_round_game_temp = 1 WHERE idetsimgame_etsim_round_game_temp = :idRound AND number_etsim_round_game_temp = :nbRound AND idetsimmember_etsim_round_game_temp = :idMember;")) {
			$updateApplyRoundGameForUser->bindParam(':idRound', $idGame);
            $updateApplyRoundGameForUser->bindParam(':nbRound', $roundGame);
            $updateApplyRoundGameForUser->bindParam(':idMember', $_SESSION['user_id']);
            //$updateApplyRoundGameForUser->bind_param('sss', $idGame, $roundGame, $_SESSION['user_id']);
			$updateApplyRoundGameForUser->execute();  
			//$updateApplyRoundGameForUser->close();
		}
	}
	
	if(isset($_GET['Mgame_id']) && isset($_GET['Mround_number'])) {
		$idGame = $_GET['Mgame_id'];
		$idRound = $_GET['Mround_number'];
		if ($SelectRoundTemp = $mysqli->prepare("SELECT * FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idRound AND number_etsim_round_game_temp = :nbRound;")) {
			$SelectRoundTemp->bindParam(':idRound', $idGame);
            $SelectRoundTemp->bindParam(':nbRound', $idRound);
			$SelectRoundTemp->execute();
			//$resultSelectRoundTemp = $SelectRoundTemp->get_result();
			while($rowresultSelectRoundTemp = $SelectRoundTemp->fetch()) {
				$id = $rowresultSelectRoundTemp['idetsimgame_etsim_round_game_temp'].$rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp'].$rowresultSelectRoundTemp['number_etsim_round_game_temp'].$rowresultSelectRoundTemp['line_etsim_round_game_temp'];
				if ($insertResults = $mysqli->prepare("REPLACE INTO etsim_round_game VALUES (:id, :idRound, :bidVolume, :bidPrice, :demandVolume, :marketPrice, :income, :cost, :benefit, :capital);")) {
                    
                    $insertResults->bindParam(':id', $id);
                    $insertResults->bindParam(':idRound', $idRound);
                    $insertResults->bindParam(':bidVolume', $rowresultSelectRoundTemp['bid_volume_etsim_round_game_temp']);
                    $insertResults->bindParam(':bidPrice', $rowresultSelectRoundTemp['bid_price_etsim_round_game_temp']);
                    $insertResults->bindParam(':demandVolume', $rowresultSelectRoundTemp['demand_voume_etsim_round_game_temp']);
                    $insertResults->bindParam(':marketPrice', $rowresultSelectRoundTemp['market_price_etsim_round_game_temp']);
                    $insertResults->bindParam(':income', $rowresultSelectRoundTemp['income_etsim_round_game_temp']);
                    $insertResults->bindParam(':cost', $rowresultSelectRoundTemp['cost_etsim_round_game_temp']);
                    $insertResults->bindParam(':benefit', $rowresultSelectRoundTemp['benefit_etsim_round_game_temp']);
                    $insertResults->bindParam(':capital', $rowresultSelectRoundTemp['capital_etsim_round_game_temp']);

					/*$insertResults->bind_param('ssssssssss', $id, $idRound, $rowresultSelectRoundTemp['bid_volume_etsim_round_game_temp'], $rowresultSelectRoundTemp['bid_price_etsim_round_game_temp'], $rowresultSelectRoundTemp['demand_voume_etsim_round_game_temp'], $rowresultSelectRoundTemp['market_price_etsim_round_game_temp'], $rowresultSelectRoundTemp['income_etsim_round_game_temp'], $rowresultSelectRoundTemp['cost_etsim_round_game_temp'], $rowresultSelectRoundTemp['benefit_etsim_round_game_temp'], $rowresultSelectRoundTemp['capital_etsim_round_game_temp']);*/
					$insertResults->execute();
					//$insertResults->close();						
				}
				if ($SelectCanContains = $mysqli->prepare("SELECT * FROM can_contains WHERE id_etsim_game = :idGame AND id_etsim_members = :idMember GROUP BY id_etsim_plant_game_contains ORDER BY id_etsim_plant_game_contains;")) {
                    $SelectCanContains->bindParam(':idGame', $idGame);
					$SelectCanContains->bindParam(':idMember', $rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp']);
					$SelectCanContains->execute();
					//$resultSelectCanContains = $SelectCanContains->get_result();
					while($rowresultSelectCanContains = $SelectCanContains->fetch()) {
						if ($InsertIntoCanContains = $mysqli->prepare("INSERT INTO can_contains (id_etsim_plant_game_contains, id_etsim_game, id_etsim_members, id_etsim_round_game) VALUES (:idPlant, :idGame, :idMember, :id);")) {
                            $InsertIntoCanContains->bindParam(':idPlant', $rowresultSelectCanContains['id_etsim_plant_game_contains']);
                            $InsertIntoCanContains->bindParam(':idGame', $idGame);
                            $InsertIntoCanContains->bindParam(':idMember', $rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp']);
                            $InsertIntoCanContains->bindParam(':id', $id);
							/*$InsertIntoCanContains->bind_param('ssss', $rowresultSelectCanContains['id_etsim_plant_game_contains'], $idGame, $rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp'], $id);*/
							$InsertIntoCanContains->execute();
							//$InsertIntoCanContains->close();
						}
					}
				}
			}
			if ($DeleteGameFromTempRound = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idGame;")) {
				$DeleteGameFromTempRound->bindParam('idGame', $idGame);
				$DeleteGameFromTempRound->execute();
				//$DeleteGameFromTempRound->close();
			}
		}
		//$SelectRoundTemp->close();
	}
    $_SESSION['roundGame']++;
}
?>