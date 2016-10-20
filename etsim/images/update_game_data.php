<?php
	include_once 'db_connect.php';
	include_once 'functions.php';
	sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if(isset($_GET['game_id']) && isset($_GET['col']) && isset($_GET['member_id'])){
		if ( $_GET['col'] == "ListeBoxUsersContains" ) {
			if ($deletememberfromgame = $mysqli->prepare("DELETE FROM can_contains WHERE id_etsim_members = ? AND id_etsim_game = ?")) {
						$deletememberfromgame->bind_param('ss', $_GET['member_id'], $_GET['game_id']);  // Lie "$email" aux paramètres.
						$deletememberfromgame->execute();    // Exécute la déclaration.
						echo 'ok';
			}
		$deletememberfromgame->close();
		return true;
		}
		if ( $_GET['col'] == "ListeBoxUsersNotContains" ) {
			$round = "0";
				if ($stmtSelectCountPLant = $mysqli->prepare("SELECT count(*) as totalPlant FROM etsim_plant;")) {
					$stmtSelectCountPLant->execute();
					$stmtSelectCountPLant->store_result();
					$stmtSelectCountPLant->bind_result($totalCount);
					$stmtSelectCountPLant->fetch();
					for($z=0;$z<5;$z++) {
						$randomIndex = rand(1,$totalCount);
						if ($stmtInsertUserGame = $mysqli->prepare("INSERT INTO can_contains (id_etsim_plant_game_contains, id_etsim_game, id_etsim_members, id_etsim_round_game) VALUES (?, ?, ?, ?);")) {
							$stmtInsertUserGame->bind_param('ssss', $randomIndex,  $_GET['game_id'], $_GET['member_id'], $round);  // Lie "$email" aux paramètres.
							$stmtInsertUserGame->execute();
							if ($selectinfoPlant = $mysqli->prepare("SELECT ep.rdt_etsim_plant, etp.minv_costs_etsim_type_plant, etp.maxv_costs_etsim_type_plant
																	 FROM etsim_plant ep
																	 INNER JOIN is_type it
																		ON ep.id_etsim_plant = it.id_etsim_plant
																	 INNER JOIN etsim_type_plant etp
																		ON it.id_etsim_type_plant = etp.id_etsim_type_plant 
																	 WHERE ep.id_etsim_plant = ?;")) {
								$selectinfoPlant->bind_param('s', $randomIndex);
								$selectinfoPlant->execute();
								$selectinfoPlant->store_result();
								$selectinfoPlant->bind_result($rdt, $minc, $maxc);
								$selectinfoPlant->fetch();
								echo $minc;
								echo '</br>';
								echo $rdt;
								echo '</br>';
								echo $maxc;
								echo '</br>';
								if ( $minc == $maxc ) {
									$varCost = ($maxc/$rdt);
								} else {
									$varCost = (rand($minc,$maxc)/$rdt);
								}
								if ($stmtInsertVcost = $mysqli->prepare("INSERT INTO have (id_etsim_members_have, v_costs_etsim_members_have, id_etsim_plant, id_etsim_game) VALUES (?, ?, ?, ?);")) {
									$stmtInsertVcost->bind_param('ssss', $_GET['member_id'], $randomIndex, $_GET['game_id'], $varCost);  // Lie "$email" aux paramètres.
									$stmtInsertVcost->execute();
									$stmtInsertVcost->close();
								} else {
									$error_msg .= "Error insert HAVE vcosts!";
								}						
							} else {
								$error_msg .= "RDT not found !";
							}
						} else {
							$error_msg .= "Error insert !";
						}
					}
				} else {
					$error_msg .= "Error random !";
				}
				$stmtSelectCountPLant->close();
				$stmtInsertUserGame->close();
		}
	}
	if(isset($_GET['id_game']) && isset($_GET['colo']) && isset($_GET['delete'])){
		if ($deletegameR = $mysqli->prepare("DELETE FROM can_contains WHERE id_etsim_game = ?;")) {
			$deletegameR->bind_param('s', $_GET['id_game']);  // Lie "$email" aux paramètres.
			$deletegameR->execute();    // Exécute la déclaration.
			if ($deletegameRoundT = $mysqli->prepare("DELETE FROM etsim_game_round_datetime WHERE id_etsim_game = ?;")) {
				$deletegameRoundT->bind_param('s', $_GET['id_game']);  // Lie "$email" aux paramètres.
				$deletegameRoundT->execute();    // Exécute la déclaration.
				$deletegameRoundT->close();
			}
			if ($deletegameT = $mysqli->prepare("DELETE FROM etsim_game WHERE id_etsim_game = ?;")) {
				$deletegameT->bind_param('s', $_GET['id_game']);  // Lie "$email" aux paramètres.
				$deletegameT->execute();    // Exécute la déclaration.
				$resetGame = $mysqli->prepare("ALTER TABLE etsim_game AUTO_INCREMENT = 1;");
				$resetGame->execute();
				$resetGame->close();
			}
		}
		$deletegameR->close();
		$deletegameT->close();
		return true;
	}

	if(isset($_GET['ttiid']) && isset($_GET['tticol']) && isset($_GET['ttival'])) {
		if ($updatenamegame = $mysqli->prepare("UPDATE etsim_game SET ".$_GET['tticol']." = \"".$_GET['ttival']."\" WHERE id_etsim_game = ".$_GET['ttiid'].";")) {
			$updatenamegame->execute();    // Exécute la déclaration.
		} else {
			$error_msg .= "erreur";
		}
			$updatenamegame->close();
	}
		
	if(isset($_GET['ssid']) && isset($_GET['sscol']) && isset($_GET['ssval'])) {
		if ($updatenamegame = $mysqli->prepare("UPDATE etsim_game SET ".$_GET['sscol']." = \"".$_GET['ssval']."\" WHERE id_etsim_game = ".$_GET['ssid'].";")) {
			$updatenamegame->execute();	
			$idgame = $_GET['ssid'];
			if ( $_GET['ssval'] == 'Open' ) {
				$deleteGameRoundTime_stmt = $mysqli->prepare("DELETE FROM etsim_game_round_datetime WHERE id_etsim_game = ?;");
				$deleteGameRoundTime_stmt->bind_param('s', $idgame);
				$deleteGameRoundTime_stmt->execute();
				$deleteGameRoundTime_stmt->close();
			} else if ( $_GET['ssval'] == 'Play' ) {
				$currentdatetime = date("Y-m-d H:i:s");
				for ($i = 1; $i <= 10; $i++) {
					$NextTime = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($currentdatetime)));
					$insertGameRoundTime_stmt = $mysqli->prepare("INSERT INTO etsim_game_round_datetime (round_number_etsim_game_round_datetime, currentdate_etsim_game_round_datetime, datetime_round_etsim_game_round_datetime, id_etsim_game) VALUES (?, ?, ?, ?)");
					$insertGameRoundTime_stmt->bind_param('ssss', $i, $currentdatetime, $NextTime, $idgame);
					$insertGameRoundTime_stmt->execute();
					$currentdatetime = $NextTime;
				}
				$insertGameRoundTime_stmt->close();
			} else {
				return true;
			}
			// Exécute la déclaration.
		} else {
			$error_msg .= "erreur";
		}
		$updatenamegame->close();
	}
}
?>