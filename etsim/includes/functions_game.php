<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 28-10-2015
*/
include_once 'psl-config.php';
include_once 'bidComputation.inc.php';
include_once 'functions.php';

if(!isset($_SESSION))
    sec_session_start();
 
$error_msg = "";
if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	function createTableGame($mysqli) {
		$tableSelectGame = "SELECT * FROM etsim_game";
		$stmttableSelectGame = $mysqli->prepare($tableSelectGame);
		$stmttableSelectGame->execute();
		//$resultstmttableSelectGame = $stmttableSelectGame->get_result();	
		while($rowresultstmttableSelectGame = $stmttableSelectGame->fetch()) {
			echo '<tr id="'.$rowresultstmttableSelectGame['id_etsim_game'].'">';
			echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="id_etsim_game" value="'.$rowresultstmttableSelectGame['id_etsim_game'].'"></td>';
			echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGame['date_etsim_game'].'" class="date_etsim_game" value="'.$rowresultstmttableSelectGame['date_etsim_game'].'"></td>';
			echo '<td><input type="text" id="'.$rowresultstmttableSelectGame['description_etsim_game'].'" class="description_etsim_game" value="'.$rowresultstmttableSelectGame['description_etsim_game'].'"></td>';
			echo '<td><select multiple="multiple" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="ListeBoxUsersContains">'; 
			$sql_usersin = "SELECT em.id_etsim_members, em.username_etsim_members, eg.id_etsim_game FROM etsim_members em INNER JOIN can_contains cc ON em.id_etsim_members = cc.id_etsim_members INNER JOIN etsim_game eg ON cc.id_etsim_game = eg.id_etsim_game WHERE eg.id_etsim_game = :idEtsimGame GROUP BY em.id_etsim_members ORDER BY em.id_etsim_members";
			if ($stmtListeBoxUsersContains = $mysqli->prepare($sql_usersin)) {
				$stmtListeBoxUsersContains->bindParam(':idEtsimGame',$rowresultstmttableSelectGame['id_etsim_game']);
				$stmtListeBoxUsersContains->execute();
				//$resultListeBoxUsersContains = $stmtListeBoxUsersContains->get_result();

				while($rowresultListeBoxUsersContains = $stmtListeBoxUsersContains->fetch()) {
					$user = $rowresultListeBoxUsersContains['id_etsim_members'].' | '.$rowresultListeBoxUsersContains['username_etsim_members'];
					echo '<option id="'.$rowresultListeBoxUsersContains['id_etsim_members'].'" value="'.$user.'" class="id_etsim_members">"'.$user.'"</option>';
				}
				//$stmtListeBoxUsersContains->close();
			} else {
				$error_msg .= "je fais de la merde";
			}
			
			echo '</select>';
			echo '</td><td>';
			echo '<select multiple="multiple" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="ListeBoxUsersNotContains">';
			$sql_userout = "SELECT em.id_etsim_members, em.username_etsim_members FROM etsim_members em WHERE NOT EXISTS (SELECT * FROM can_contains cc WHERE em.id_etsim_members = cc.id_etsim_members AND cc.id_etsim_game = :idEtsimGame)";
			if ($stmtListeBoxUsersNotContains = $mysqli->prepare($sql_userout)) {
				$stmtListeBoxUsersNotContains->bindParam(':idEtsimGame',$rowresultstmttableSelectGame['id_etsim_game']);
				$stmtListeBoxUsersNotContains->execute();
				//$resultstmtListeBoxUsersNotContains = $stmtListeBoxUsersNotContains->get_result();

				while($rowresultstmtListeBoxUsersNotContains = $stmtListeBoxUsersNotContains->fetch()) {
					$user = $rowresultstmtListeBoxUsersNotContains['id_etsim_members'].' | '.$rowresultstmtListeBoxUsersNotContains['username_etsim_members'];
					echo '<option id="'.$rowresultstmtListeBoxUsersNotContains['id_etsim_members'].'" class="id_etsim_members"  value="'.$user.'">"'.$user.'"</option>';
				}
				//$stmtListeBoxUsersNotContains->close();
			} else {
				$error_msg .= "je fais de la merde";
			}
			echo '</select>';
			echo '</td><td>';
			echo '<select id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="status_etsim_game">';
			echo '<option value="'.$rowresultstmttableSelectGame['status_etsim_game'].'" selected>'.$rowresultstmttableSelectGame['status_etsim_game'].'</option>';
			if ( strcmp($rowresultstmttableSelectGame['status_etsim_game'], "Play" )) {
				echo '<option value="Play">Play</option>';
			}
			if ( strcmp($rowresultstmttableSelectGame['status_etsim_game'], "Open" )) {
				echo '<option value="Open">Open</option>';
			}
			if ( strcmp($rowresultstmttableSelectGame['status_etsim_game'], "Close" )) {
				echo '<option value="Close">Close</option>';
			}
			if ( strcmp($rowresultstmttableSelectGame['status_etsim_game'], "Completed" )) {
				echo '<option value="Completed">Completed</option>';
			}
			echo '</select></td>';
			echo '<td><button type="button" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="viewgame_etsim_game" />VIEW</button></td>';
			echo '<td><button type="button" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="delete_etsim_game">Delete</button></td></tr>';
		}
		//$stmttableSelectGame->close();
	}

	function createTablePlant($mysqli){
		$tableSelectPlant = "SELECT * FROM etsim_plant ep INNER JOIN is_type it ON ep.id_etsim_plant = it.id_etsim_plant INNER JOIN etsim_type_plant etp ON it.id_etsim_type_plant = etp.id_etsim_type_plant;";
		if ($stmttableSelectPlant = $mysqli->prepare($tableSelectPlant)) {
			$stmttableSelectPlant->execute();
			//$resultstmttableSelectPlant = $stmttableSelectPlant->get_result();
		
			while($rowresultstmttableSelectPlant = $stmttableSelectPlant->fetch()) {
				echo '<tr id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'">';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="id_etsim_plant" value="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'"></td>';
				echo '<td><select id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="name_etsim_type_plant">'; 
				$tableSelectTypePlant = "SELECT * FROM etsim_type_plant;";
				if ($stmttableSelectTypePlant = $mysqli->prepare($tableSelectTypePlant)) {
					$stmttableSelectTypePlant->execute();
					//$resultstmttableSelectTypePlant = $stmttableSelectTypePlant->get_result();
					while($rowresultstmttableSelectTypePlant = $stmttableSelectTypePlant->fetch()) {
						if ( $rowresultstmttableSelectPlant['name_etsim_type_plant'] == $rowresultstmttableSelectTypePlant['name_etsim_type_plant'] ) {	
							echo '<option id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" value="'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'" selected>"'.$rowresultstmttableSelectPlant['name_etsim_type_plant'].'"</option>';
						} else {
							echo '<option id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" value="'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'">"'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'"</option>';
						}
					}
				} else {
					$error_msg .= "Error DB access : etsim_type_plant";
				}
				// echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="description_etsim_type_plant" value="'.$rowresultstmttableSelectPlant['description_etsim_type_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="power_unit_etsim_plant" value="'.$rowresultstmttableSelectPlant['power_unit_etsim_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="cost_mw_etsim_plant" value="'.$rowresultstmttableSelectPlant['cost_mw_etsim_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="om_mw_etsim_plant" value="'.$rowresultstmttableSelectPlant['om_mw_etsim_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="rdt_etsim_plant" value="'.$rowresultstmttableSelectPlant['rdt_etsim_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="construction_etsim_plant" value="'.$rowresultstmttableSelectPlant['construction_etsim_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="operation_etsim_plant" value="'.$rowresultstmttableSelectPlant['operation_etsim_plant'].'"></td>';
				echo '<td><button type="button" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="delete_etsim_plant">Delete</button></td></tr>';
			}
		} else {
			$error_msg .= "Error DB access : etsim_plant & etsim_type_plant";
		}
		//$stmttableSelectPlant->close();
		//$stmttableSelectTypePlant->close();
	}

	function createTableTypePlant($mysqli){
		$tableSelectTypePlant = "SELECT * FROM etsim_type_plant;";
		if ($stmttableSelectTypePlant = $mysqli->prepare($tableSelectTypePlant)) {
			$stmttableSelectTypePlant->execute();
			//$resultstmttableSelectTypePlant = $stmttableSelectTypePlant->get_result();
		
			while($rowresultstmttableSelectTypePlant = $stmttableSelectTypePlant->fetch()) {
				echo '<tr id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'">';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="id_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="name_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="description_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['description_etsim_type_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="minv_costs_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['minv_costs_etsim_type_plant'].'"></td>';
				echo '<td><input type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="maxv_costs_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['maxv_costs_etsim_type_plant'].'"></td>';
				echo '<td><button type="button" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="delete_etsim_type_plant">Delete</button></td></tr>';
			}
		} else {
			$error_msg .= "Error DB access : etsim_type_type_plant";
		}
		//$resultstmttableSelectTypePlant->close();
	}
	
	function createSelectTypePlant($mysqli){
		$tableSelectTypePlant = "SELECT * FROM etsim_type_plant;";
		if ($stmttableSelectTypePlant = $mysqli->prepare($tableSelectTypePlant)) {
			$stmttableSelectTypePlant->execute();
			//$resultstmttableSelectTypePlant = $stmttableSelectTypePlant->get_result();
		
			while($rowresultstmttableSelectTypePlant = $stmttableSelectTypePlant->fetch()) {
				echo '<option id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" value="'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'">'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'</option>';
			}
		} else {
			$error_msg .= "Error DB access : etsim_type_type_plant";
		}
		//$resultstmttableSelectTypePlant->close();
	}
}
	if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player" ) {
		function getCostPlant($mysqli,$idPlant,$idGame){
			//do the select and compute the price
			//return the price
			if($a=$mysqli->prepare("select fixed_costs_etsim_plant, v_costs_etsim_members_have from etsim_plant p
									INNER JOIN have ha
													ON p.id_etsim_plant = ha.id_etsim_plant

								where
									 p.id_etsim_plant = :idEtsimPlant and ha.id_etsim_game=:idEtsimGame")) {
				;
				$a->bindParam(':idEtsimPlant', $idPlant);
                $a->bindParam(':idEtsimGame', $idGame);
				$a->execute();
				//$r = $a->get_result()->fetch_array();
                $r = $a->fetch();
				//$a->close();
				return $r;
			}
			else{
				echo "unable to update round";
				die();
			}
		}
		function createTableGameOpen($mysqli) {
			$tableSelectGameNotRegister = "	SELECT eg.id_etsim_game 
										FROM etsim_game eg
										WHERE NOT EXISTS (
											SELECT * 
											FROM can_contains cc 
											WHERE cc.id_etsim_game = eg.id_etsim_game 
											AND cc.id_etsim_members = :idMember );";

			if( $stmttableSelectGameNotRegister = $mysqli->prepare($tableSelectGameNotRegister) ) {
                $stmttableSelectGameNotRegister->bindParam(':idMember', $_SESSION['user_id']);
				$stmttableSelectGameNotRegister->execute();
                
                //echo $tableSelectGameNotRegister;
				//$resultstmttableSelectGameNotRegister = $stmttableSelectGameNotRegister->get_result();
				
				while($rowresultstmttableSelectGameNotRegister = $stmttableSelectGameNotRegister->fetch()) {
					$tableSelectGameOpen = "SELECT * FROM etsim_game WHERE id_etsim_game = :idEtsimGame AND (status_etsim_game = 'Open' OR status_etsim_game = 'Play')";
					if( $stmttableSelectGameOpen = $mysqli->prepare($tableSelectGameOpen) ) {
						$stmttableSelectGameOpen->bindParam(':idEtsimGame', $rowresultstmttableSelectGameNotRegister['id_etsim_game']);
						$stmttableSelectGameOpen->execute();
						//$resultstmttableSelectGameOpen = $stmttableSelectGameOpen->get_result();
						while($rowresultstmttableSelectGameOpen = $stmttableSelectGameOpen->fetch()) {
							echo '<tr id="'.$rowresultstmttableSelectGameOpen['id_etsim_game'].'">';
							echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameOpen['id_etsim_game'].'" class="date_etsim_game" value="'.$rowresultstmttableSelectGameOpen['date_etsim_game'].'"></td>';
							echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameOpen['id_etsim_game'].'" class="description_etsim_game" value="'.$rowresultstmttableSelectGameOpen['description_etsim_game'].'"></td>';
							echo '<td><input type="text" id="'.$rowresultstmttableSelectGameOpen['id_etsim_game'].'" class="password_etsim_game"></td>';
							echo '<td><button type="button" id="'.$rowresultstmttableSelectGameOpen['id_etsim_game'].'" class="join_etsim_game" >JOIN GAME</button></td></tr>';
						}
					//$resultstmttableSelectGameOpen->close();
					} else {
						$error_msg .= " Error access etsime game ! ";
					}
				}
				//$resultstmttableSelectGameNotRegister->close();
			} else {
				$error_msg .= " Error access etsime game ! ";
            }
        }
		function createTableGameInGame($mysqli) {
			$tableSelectGameRegister = "	SELECT * 
											FROM etsim_game eg
											INNER JOIN can_contains cc 
											ON cc.id_etsim_game = eg.id_etsim_game 
											INNER JOIN etsim_members em 
											ON cc.id_etsim_members = em.id_etsim_members
											WHERE cc.id_etsim_members = :idMember
											AND eg.status_etsim_game = 'Play'
											GROUP BY eg.id_etsim_game
											ORDER BY eg.id_etsim_game";
			if( $stmttableSelectGameRegister = $mysqli->prepare($tableSelectGameRegister) ) {
                $stmttableSelectGameRegister->bindParam(':idMember', $_SESSION['user_id']);
				$stmttableSelectGameRegister->execute();
				//$resultstmttableSelectGameRegister = $stmttableSelectGameRegister->get_result();

				while($rowresultstmttableSelectGameRegister = $stmttableSelectGameRegister->fetch()) {
					echo '<tr id="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'"><form action="inGame.php" method="post" class="enterInGame"><input type="hidden" name="goInGame" value="goInGame"/>';
					echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'" class="id_etsim_game" value="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'"><input type="hidden" name="id_etsim_game" value="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'"></td>';
					echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'" class="date_etsim_game" value="'.$rowresultstmttableSelectGameRegister['date_etsim_game'].'"><input type="hidden" name="date_etsim_game" value="'.$rowresultstmttableSelectGameRegister['date_etsim_game'].'"></td>';
					echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'" class="description_etsim_game" value="'.$rowresultstmttableSelectGameRegister['description_etsim_game'].'"><input type="hidden" name="description_etsim_game" value="'.$rowresultstmttableSelectGameRegister['description_etsim_game'].'"></td>';
					echo '<td><input type="submit" name="register" id="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'" value="ENTER IN GAME" class="show_your_etsim_game" /></td></form>';
					echo '<td><button type="button" id="'.$rowresultstmttableSelectGameRegister['id_etsim_game'].'" class="leave_etsim_game">LEAVE GAME</button></td></tr>';
				}
				//$resultstmttableSelectGameRegister->close();
			} else {
				$error_msg .= " Error access etsime game ! ";
            }
        }
		function createTableGameCompletedGame($mysqli) {
			$tableSelectCompletedGame = "	SELECT * 
											FROM etsim_game eg
											INNER JOIN can_contains cc 
											ON cc.id_etsim_game = eg.id_etsim_game 
											INNER JOIN etsim_members em 
											ON cc.id_etsim_members = em.id_etsim_members
											WHERE cc.id_etsim_members = :idMember
											AND eg.status_etsim_game = 'Completed'
											GROUP BY eg.id_etsim_game
											ORDER BY eg.id_etsim_game";
			if( $stmttableSelectCompletedGame = $mysqli->prepare($tableSelectCompletedGame) ) {
                $stmttableSelectCompletedGame->bindParam(':idMember', $_SESSION['user_id']);
				$stmttableSelectCompletedGame->execute();
				//$resultstmttableSelectCompletedGame = $stmttableSelectCompletedGame->get_result();

				while($rowresultstmttableSelectCompletedGame = $stmttableSelectCompletedGame->fetch()) {
					echo '<tr id="'.$rowresultstmttableSelectCompletedGame['id_etsim_game'].'">';
					echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectCompletedGame['id_etsim_game'].'" class="date_etsim_game" value="'.$rowresultstmttableSelectCompletedGame['date_etsim_game'].'"></td>';
					echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectCompletedGame['id_etsim_game'].'" class="description_etsim_game" value="'.$rowresultstmttableSelectCompletedGame['description_etsim_game'].'"></td>';
					echo '<td><button type="button" id="'.$rowresultstmttableSelectCompletedGame['id_etsim_game'].'" class="show_your_etsim_game">SHOW RESULTS</button>';
				}
				//$resultstmttableSelectCompletedGame->close();
			} else {
				$error_msg .= " Error access etsime game ! ";
            }
        }
		
		function showtimeround($mysqli, $idGame, $idRound) {
			if ($SelectLimitDatetimeRound = $mysqli->prepare("SELECT datetime_round_etsim_game_round_datetime FROM etsim_game_round_datetime WHERE id_etsim_game = :idEtsimGame AND round_number_etsim_game_round_datetime = :roundNbEtsimGame;")) {
				$SelectLimitDatetimeRound->bindParam(':idEtsimGame', $idGame);  // Lie "$email" aux paramètres.
                $SelectLimitDatetimeRound->bindParam(':roundNbEtsimGame', $idRound); 
				$SelectLimitDatetimeRound->execute();    // Exécute la déclaration.
				//$SelectLimitDatetimeRound->store_result();
				$SelectLimitDatetimeRound->bindColumn('datetime_round_etsim_game_round_datetime',$dateEndRound);
				$SelectLimitDatetimeRound->fetch();
				$today = date("Y-m-d H:i:s");
				$dteDiff  = strtotime($dateEndRound) - strtotime($today);
				$dteDiff = (int)$dteDiff;
				return $dteDiff;
			}
			//$SelectLimitDatetimeRound->close();
		}
		
		function showdemandPowerround($mysqli, $idGame, $idRound) {
			if ($SelectdemandPower = $mysqli->prepare("SELECT demand_power_per_round FROM etsim_game_round_datetime WHERE id_etsim_game = :idEtsimGame AND round_number_etsim_game_round_datetime = :roundNbEtsimGame;")) {
				$SelectdemandPower->bindParam(':idEtsimGame', $idGame);  // Lie "$email" aux paramètres.
                $SelectdemandPower->bindParam(':roundNbEtsimGame', $idRound); 
				$SelectdemandPower->execute();    // Exécute la déclaration.
				//$SelectdemandPower->store_result();
				$SelectdemandPower->bindColumn('demand_power_per_round',$demandPower);
				$SelectdemandPower->fetch();
				return $demandPower;
			}
			//$SelectdemandPower->close();
		}
		
		function countUserTotalInGame($mysqli, $idGame) {
			$countUserTotalInGame = 0;
			if ($SelectcountUserTotalInGame = $mysqli->prepare("SELECT * FROM can_contains WHERE id_etsim_game = :idEtsimGame GROUP BY id_etsim_game, id_etsim_members ORDER BY id_etsim_members;")) {
				$SelectcountUserTotalInGame->bindParam(':idEtsimGame', $idGame);  // Lie "$email" aux paramètres.
				$SelectcountUserTotalInGame->execute();    // Exécute la déclaration.
				//$resultSelectcountUserTotalInGame = $SelectcountUserTotalInGame->get_result();
					while($rowresultSelectcountUserTotalInGame = $SelectcountUserTotalInGame->fetch()) {
						$countUserTotalInGame++;
					}
				return $countUserTotalInGame;
			}
			//$SelectcountUserTotalInGame->close();
		}
		
		function countUserTotalInGameFinnishRound($mysqli, $idGame, $idRound) {
			$countUserTotalInGameFinnishRound = 0;
			if ($SelectcountUserTotalInGameFinnishRound = $mysqli->prepare("SELECT * FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idEtsimGame AND number_etsim_round_game_temp = :nbEtsimRound AND finnish_etsim_round_game_temp = 1 GROUP BY idetsimgame_etsim_round_game_temp, 	idetsimmember_etsim_round_game_temp, number_etsim_round_game_temp, finnish_etsim_round_game_temp ORDER BY number_etsim_round_game_temp;")) {
				$SelectcountUserTotalInGameFinnishRound->bindParam(':idEtsimGame', $idGame);
                $SelectcountUserTotalInGameFinnishRound->bindParam(':nbEtsimRound', $idRound);
				$SelectcountUserTotalInGameFinnishRound->execute();
				//$resultSelectcountUserTotalInGameFinnishRound = $SelectcountUserTotalInGameFinnishRound->get_result();
						while($rowresultSelectcountUserTotalInGameFinnishRound = $SelectcountUserTotalInGameFinnishRound->fetch()) {
							$countUserTotalInGameFinnishRound++;
						}
				return $countUserTotalInGameFinnishRound;
			}
			//$SelectcountUserTotalInGameFinnishRound->close();
		}
		
		function statusCurrentRoundGame($mysqli, $idGame, $idRound) {
			if ($SelectcountUserInGameFinnishRound = $mysqli->prepare("SELECT finnish_etsim_round_game_temp FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idEtsimGame AND number_etsim_round_game_temp = :nbEtsimRound AND idetsimmember_etsim_round_game_temp = :idEtsimMember GROUP BY finnish_etsim_round_game_temp ORDER BY number_etsim_round_game_temp")) {
				$SelectcountUserInGameFinnishRound->bindParam(':idEtsimGame', $idGame);
                $SelectcountUserInGameFinnishRound->bindParam(':nbEtsimRound', $idRound);
                $SelectcountUserInGameFinnishRound->bindParam(':idEtsimMember', $_SESSION['user_id']);
				$SelectcountUserInGameFinnishRound->execute();
				//$SelectcountUserInGameFinnishRound->store_result();
				$SelectcountUserInGameFinnishRound->bindColumn('finnish_etsim_round_game_temp',$statusRoundForUser);
				$SelectcountUserInGameFinnishRound->fetch();
				return $statusRoundForUser;
			}
			//$SelectcountUserInGameFinnishRound->close();
		}
		
		function applyRoundGame($mysqli, $idGame, $idRound) {
			//check first if the round isn't saved yet
			$temprequest=$mysqli->prepare("select count(*) from etsim_round_game where id_etsim_round_game like '%:idGame-:userId-:idRound-%'");
			$temprequest->bindParam(':idGame',$idGame);
            $temprequest->bindParam(':userId',$_SESSION['user_id']);
            $temprequest->bindParam(':idRound',$idRound);
			$temprequest->execute();
			//$tempresult=$temprequest->get_result();
			if($r=$tempresult->fetch()){
				if($r[0]>0)
					return false;
			}

			if ($SelectRoundTemp = $mysqli->prepare("SELECT * FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idGame AND number_etsim_round_game_temp = :idRound AND finnish_etsim_round_game_temp = 1;")) {
				$SelectRoundTemp->bindParam(':idGame', $idGame);
                $SelectRoundTemp->bindParam(':idRound', $idRound);
				$SelectRoundTemp->execute();
				//$resultSelectRoundTemp = $SelectRoundTemp->get_result();
				$valueArray=array();
				$demand=0;
				$plantarray=[];
				$totalVolume=0;
				$lineNumber=0;
				while($rowresultSelectRoundTemp = $SelectRoundTemp->fetch()) {
					$tempArray=array(4);
					$tempArray[0]=array();
					$tempArray[0][]=$rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp'];
					$tempArray[0][]=$rowresultSelectRoundTemp['line_etsim_round_game_temp'];
					$lineNumber=max($lineNumber,$tempArray[0][1]);
					$tempArray[1]=$rowresultSelectRoundTemp['bid_price_etsim_round_game_temp'];
					$tempArray[2]=$rowresultSelectRoundTemp['bid_volume_etsim_round_game_temp'];
					$totalVolume+=$tempArray[2];
					$tempArray[3]=getCostPlant($mysqli,$rowresultSelectRoundTemp['idplant_etsim_round_game_temp'],$idGame);
					$valueArray[]=$tempArray;
					$plantarray[]=$rowresultSelectRoundTemp['idplant_etsim_round_game_temp'];
					$demand=$rowresultSelectRoundTemp['demand_voume_etsim_round_game_temp'];
					//die();
					$id = $rowresultSelectRoundTemp['idetsimgame_etsim_round_game_temp']	.'-'.$rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp'].'-'.$rowresultSelectRoundTemp['number_etsim_round_game_temp'].'-'.$rowresultSelectRoundTemp['line_etsim_round_game_temp'];
					if ($insertResults = $mysqli->prepare("REPLACE INTO etsim_round_game VALUES (:id, :idRound, :bidVol, :bidPrice, :demandeVoume, :marketPrice, :incomeEtsim, :costEtsim, :benefitEtsim, :captialEtsim);")) {
						$insertResults->bindParam(':id', $id);
                        $insertResults->bindParam(':idRound', $idRound);
                        $insertResults->bindParam(':bidVol', $rowresultSelectRoundTemp['bid_volume_etsim_round_game_temp']); $insertResults->bindParam(':bidPrice',$rowresultSelectRoundTemp['bid_price_etsim_round_game_temp']); $insertResults->bindParam(':demandeVoume',$rowresultSelectRoundTemp['demand_voume_etsim_round_game_temp']); $insertResults->bindParam(':marketPrice',$rowresultSelectRoundTemp['market_price_etsim_round_game_temp']); $insertResults->bindParam(':incomeEtsim',$rowresultSelectRoundTemp['income_etsim_round_game_temp']); $insertResults->bindParam(':costEtsim',$rowresultSelectRoundTemp['cost_etsim_round_game_temp']); $insertResults->bindParam(':benefitEtsim',$rowresultSelectRoundTemp['benefit_etsim_round_game_temp']); $insertResults->bindParam(':captialEtsim',$rowresultSelectRoundTemp['capital_etsim_round_game_temp']);
                        
                        
					//	$insertResults->execute();
											
					}
					if ($SelectCanContains = $mysqli->prepare("SELECT * FROM can_contains WHERE id_etsim_game = :idGame AND id_etsim_members = :idMember GROUP BY id_etsim_plant_game_contains ORDER BY id_etsim_plant_game_contains;")) {
						$SelectCanContains->bindParam(':idGame', $idGame);
                        $SelectCanContains->bindParam(':idGame', $rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp']);
						$SelectCanContains->execute();
						//$resultSelectCanContains = $SelectCanContains->get_result();
						while($rowresultSelectCanContains = $SelectCanContains->fetch()) {
							if ($InsertIntoCanContains = $mysqli->prepare("INSERT INTO can_contains (id_etsim_plant_game_contains, id_etsim_game, id_etsim_members, id_etsim_round_game) VALUES (:idEtsimPlant, :idEtsimGame, :idEtsimMember, :idEtsimRound);")) {
								$InsertIntoCanContains->bindParam(':idEtsimPlant',$rowresultSelectCanContains['id_etsim_plant_game_contains']);
                                $InsertIntoCanContains->bindParam(':idEtsimGame',$idGame);
                                $InsertIntoCanContains->bindParam(':idEtsimMember',$rowresultSelectRoundTemp['idetsimmember_etsim_round_game_temp']);
                                $InsertIntoCanContains->bindParam(':idEtsimRound',$id);
								$InsertIntoCanContains->execute();
								//$InsertIntoCanContains->close();
							}
						}
					}
				}
				$plantrequest=$mysqli->prepare('select p.id_etsim_plant,power_unit_etsim_plant, cost_mw_etsim_plant, v_costs_etsim_members_have from etsim_plant p INNER JOIN have ha ON p.id_etsim_plant = ha.id_etsim_plant where ha.id_etsim_members_have = :idUser and ha.id_etsim_game=:idGame');
				$plantrequest->bindParam(':idUser',$_SESSION['user_id']);
                $plantrequest->bindParam(':idGame',$idGame);
				$plantrequest->execute();
				//$plantresult=$plantrequest->get_result();
				$lineNumber=100; // to change from the normal line
				while($plantrequestitem = $plantrequest->fetch()){
					if(!(in_array($plantrequestitem["id_etsim_plant"],$plantarray))){
						$tempArray=array(4);
						$tempArray[0]=array();
						$tempArray[0][]=$_SESSION['user_id'];
						$lineNumber++;
						$tempArray[0][]=$lineNumber;
						//$tempArray[1]=$rowresultSelectRoundTemp['bid_price_etsim_round_game_temp'];
						$tempArray[3]=getCostPlant($mysqli,$plantrequestitem["id_etsim_plant"],$idGame);
					//	echo $totalVolume." ".$demand."</br>";
						if($totalVolume<$demand){
							$tempArray[2]=min($demand-$totalVolume,$plantrequestitem['power_unit_etsim_plant']);
							$totalVolume+=$tempArray[2];
							$tempArray[1]=getMaxprice();
						}else if($totalVolume>=$demand){
							$tempArray[2]=0;
							$tempArray[1]=0;
						}
						//echo $tempArray[1].' '.$tempArray[2].' </br>';
					//	var_dump($tempArray);
						$valueArray[]=$tempArray;

					}
				}

				if ($DeleteGameFromTempRound = $mysqli->prepare("DELETE FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idGame;")) {
					$DeleteGameFromTempRound->bindParam(':idGame', $idGame);
					$DeleteGameFromTempRound->execute();
					//$DeleteGameFromTempRound->close();
				}
				$result=computebids($valueArray,$demand);
				foreach($result[2] as $r){
					$cp =$result[1];
					$idMember=$r[0][0];
					$idLine=$r[0][1];
					$price=$r[1];
					$volume=$r[2];
					$income=floatval($price)*floatval($volume);
					$plantcost=$r[3];
					$cost=floatval($plantcost[1])*floatval($volume)+floatval($plantcost[0]);
					$benefit=$income-floatval($cost);
					updateGameLine($mysqli,$idGame,$idRound,$idMember,$idLine,$volume,$price,$demand,$cp,$income,$benefit,$cost);
				}
				foreach($result[3] as $r){
					$cp =$result[1];
					$idMember=$r[0][0];
					$idLine=$r[0][1];
					$price=$r[1];
					$volume=$r[2];
					$plantcost=$r[3];
					$cost=floatval($plantcost["v_costs_etsim_members_have"])*floatval($volume)+floatval($plantcost["cost_mw_etsim_plant"]);
					$benefit=-floatval($cost);
					updateGameLine($mysqli,$idGame,$idRound,$idMember,$idLine,$volume,$price,$demand,$cp,0,$benefit,$cost);
				}
			}
			//die();
			//$SelectRoundTemp->close();
			return true;
		}
		function updateGameLine($mysqli,$idGame,$idRound,$idMember,$idLine,$volume,$price,$demand,$cp,$income,$benefit,$cost){
			$id="$idGame-$idMember-$idRound-$idLine";
			$SQL="insert into etsim_round_game values (
						 '$id',
						 $idRound,
						 $volume,
						 $price,
						 $demand,
						 $cp,
						 $income,
						 $cost,
						 $benefit,
						0)
";
			$updateGameLine=$mysqli->prepare($SQL);
			//if($updateGameLine==false){
			//echo $SQL;
			//}
			$updateGameLine->execute();
			//$updateGameLine->close();
		}
		function getMaxprice(){
			return 180;
		}
	}
?>