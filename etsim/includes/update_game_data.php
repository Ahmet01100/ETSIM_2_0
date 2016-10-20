<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 09-12-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if(isset($_GET['game_id']) && isset($_GET['col']) && isset($_GET['member_id'])){
		if ( $_GET['col'] == "ListeBoxUsersContains" ) {
			if ($deletememberfromgame = $mysqli->prepare("DELETE FROM can_contains WHERE id_etsim_members = ? AND id_etsim_game = ?")) {
				$deletememberfromgame->bind_param('ss', $_GET['member_id'], $_GET['game_id']);
				$deletememberfromgame->execute();
				if ($deleteplanthave = $mysqli->prepare("DELETE FROM have WHERE id_etsim_members_have = ? AND id_etsim_game = ?;")) {
					$deleteplanthave->bind_param('ss', $_GET['member_id'], $_GET['game_id']); 
					$deleteplanthave->execute();
					$deleteplanthave->close();
				} else {
					$error_msg .= "Error delete users and game to HAVE!";
				}
				if ($deleteroundtemp = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimmember_etsim_round_game_temp = ? AND idetsimgame_etsim_round_game_temp = ?;")) {
					$deleteroundtemp->bind_param('ss', $_GET['member_id'], $_GET['game_id']); 
					$deleteroundtemp->execute();
					$deleteroundtemp->close();
				} else {
					$error_msg .= "Error delete users and game to HAVE!";
				}
				if ($deleteround = $mysqli->prepare("DELETE FROM etsim_round_game WHERE id_etsim_round_game like ?;")) {
					$idR = $_GET['game_id'].'-'.$_GET['member_id']."%";
					echo $idR;
					$deleteround->bind_param('s', $idR); 
					$deleteround->execute();
					$deleteround->close();
				} else {
					$error_msg .= "Error delete users and game to HAVE!";
				}
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
				$stack = array();
				for( $z = 0 ; $z < 5 ; $z++ ) {
					$randomIndex = rand(1,$totalCount);
					while (in_array($randomIndex, $stack, true)) {
						$randomIndex = rand(1,$totalCount);
					}
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
							if ( $minc == $maxc ) {
								$varCost =  ($maxc/$rdt);
							} else {
								$randc = rand($minc,$maxc);
								$varCost = ($randc/$rdt);
							}
							if ($stmtInsertVcost = $mysqli->prepare("INSERT INTO have (id_etsim_members_have, v_costs_etsim_members_have, id_etsim_plant, id_etsim_game) VALUES (?, ?, ?, ?);")) {
								$stmtInsertVcost->bind_param('ssss', $_GET['member_id'], $varCost, $randomIndex, $_GET['game_id']);
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
					array_push($stack, $randomIndex);
					print_r($stack);
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
			$deletegameR->bind_param('s', $_GET['id_game']);
			$deletegameR->execute();
			if ($deletehave = $mysqli->prepare("DELETE FROM have WHERE id_etsim_game = ?;")) {
				$deletehave->bind_param('s', $_GET['id_game']); 
				$deletehave->execute();
				$deletehave->close();
			} else {
				$error_msg .= "Error delete users and game to HAVE!";
			}
			if ($deletegameRoundT = $mysqli->prepare("DELETE FROM etsim_game_round_datetime WHERE id_etsim_game = ?;")) {
				$deletegameRoundT->bind_param('s', $_GET['id_game']); 
				$deletegameRoundT->execute();
				$deletegameRoundT->close();
			}
			if ($deletegameT = $mysqli->prepare("DELETE FROM etsim_game WHERE id_etsim_game = ?;")) {
				$deletegameT->bind_param('s', $_GET['id_game']);
				$deletegameT->execute();
				$resetGame = $mysqli->prepare("ALTER TABLE etsim_game AUTO_INCREMENT = 1;");
				$resetGame->execute();
				$resetGame->close();
			}
			if ($deleteroundtemp = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = ?;")) {
				$deleteroundtemp->bind_param('s', $_GET['id_game']); 
				$deleteroundtemp->execute();
				$deleteroundtemp->close();
			} else {
				$error_msg .= "Error delete users and game to etsim_round_game_temp!";
			}
			if ($deleteround = $mysqli->prepare("DELETE FROM etsim_round_game WHERE id_etsim_round_game like ?;")) {
				$idR = $_GET['id_game']."%";
				$deleteround->bind_param('s', $idR); 
				$deleteround->execute();
				$deleteround->close();
			} else {
				$error_msg .= "Error delete users and game to HAVE!";
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
				$deleteGameRoundTimeTemp_stmt = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = ?;");
				$deleteGameRoundTimeTemp_stmt->bind_param('s', $idgame);
				$deleteGameRoundTimeTemp_stmt->execute();
				$idR = $idgame."%";
				$deleteGameCC_stmt = $mysqli->prepare("DELETE FROM can_contains WHERE id_etsim_round_game like ?;");
				$deleteGameCC_stmt->bind_param('s', $idR);
				$deleteGameCC_stmt->execute();
				$deleteGameRound_stmt = $mysqli->prepare("DELETE FROM etsim_round_game WHERE id_etsim_round_game like ?;");
				$deleteGameRound_stmt->bind_param('s', $idR);
				$deleteGameRound_stmt->execute();
				$deleteGameRoundTime_stmt->close();
				$deleteGameRoundTimeTemp_stmt->close();
				$deleteGameCC_stmt->close();
				$deleteGameRound_stmt->close();
			} else if ( $_GET['ssval'] == 'Play' ) {
				$currentdatetime = date("Y-m-d H:i:s");
				for ($i = 1; $i <= 10; $i++) {
					$NextTime = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($currentdatetime)));
					// $demandP = rand(2000,4000);
					$demand = Array(1750, 1875, 2125, 2000, 2250, 2375, 3000, 3150, 3500, 4750);
					$demandP = rand(0,9);
					$value= $demand[$demandP];
					
					$insertGameRoundTime_stmt = $mysqli->prepare("INSERT INTO etsim_game_round_datetime (round_number_etsim_game_round_datetime, currentdate_etsim_game_round_datetime, datetime_round_etsim_game_round_datetime, id_etsim_game, demand_power_per_round) VALUES (?, ?, ?, ?, ?)");
					$insertGameRoundTime_stmt->bind_param('sssss', $i, $currentdatetime, $NextTime, $idgame, $value);
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