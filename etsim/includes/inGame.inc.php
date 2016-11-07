<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 13-12-2015
*/
include_once 'db_connect.php';
include_once 'functions.php';
if(!isset($_SESSION))
    sec_session_start();

if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Player') {
	function CurrentGameResults($mysqli, $idGame) {
		$uId=$_SESSION['user_id'];
		$tableSelectGameResults = "
  SELECT erg.number_etsim_round_game,
 	sum(erg.bid_volume_etsim_round_game) as bid_volume_etsim_round_game,
 	erg.bid_price_etsim_round_game,
 	erg.demand_voume_etsim_round_game,
 	erg.market_price_etsim_round_game,
 	sum(erg.income_etsim_round_game) as income_etsim_round_game,
    (sum(success)/count(*))*100 as ratio,
 	sum(erg.cost_etsim_round_game) as cost_etsim_round_game,
 	sum(erg.benefit_etsim_round_game) as benefit_etsim_round_game
 	FROM (
           SELECT erg.number_etsim_round_game,
 				 erg.bid_volume_etsim_round_game,
 			 	erg.bid_price_etsim_round_game,
 				erg.demand_voume_etsim_round_game,
 	 			erg.market_price_etsim_round_game,
 			    erg.income_etsim_round_game,
    			if(erg.income_etsim_round_game <=0,if(erg.bid_volume_etsim_round_game=0,1,0),1) as success,
 				erg.cost_etsim_round_game,
 				erg.benefit_etsim_round_game as benefit_etsim_round_game
        	from etsim_round_game erg
 			WHERE erg.id_etsim_round_game like '$idGame-$uId-%' and erg.number_etsim_round_game>0) erg
            group by number_etsim_round_game
";
		if( $stmttableSelectGameResults = $mysqli->prepare($tableSelectGameResults) ) {
			$stmttableSelectGameResults->execute();
			//$resultstmttableSelectGameResults = $stmttableSelectGameResults->get_result();
			$roundarray=[];
			$costarray=[];
			$profitarray=[];
			$benefarray=[];
			$capital=0;
			while($rowresultstmttableSelectGameResults = $stmttableSelectGameResults->fetch()) {
				$idRoundGame = $rowresultstmttableSelectGameResults['id_round_etsim_game'];
				$roundarray[]=$rowresultstmttableSelectGameResults['number_etsim_round_game'];
				$costarray[]=$rowresultstmttableSelectGameResults['cost_etsim_round_game'];
				$profitarray[]=$rowresultstmttableSelectGameResults['income_etsim_round_game'];
				$benefarray[]=$rowresultstmttableSelectGameResults['benefit_etsim_round_game'];
				$capital+=$rowresultstmttableSelectGameResults['benefit_etsim_round_game'];

				echo '<tr><td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['number_etsim_round_game'].'" class="number_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['number_etsim_round_game'].'"><input type="hidden" name="number_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['number_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['bid_volume_etsim_round_game'].'" class="bid_volume_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['bid_volume_etsim_round_game'].'"><input type="hidden" name="bid_volume_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['bid_volume_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['demand_voume_etsim_round_game'].'" class="demand_voume_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['demand_voume_etsim_round_game'].'"><input type="hidden" name="demand_voume_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['demand_voume_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['market_price_etsim_round_game'].'" class="market_price_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['market_price_etsim_round_game'].'"><input type="hidden" name="market_price_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['market_price_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['income_etsim_round_game'].'" class="income_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['income_etsim_round_game'].'"><input type="hidden" name="income_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['income_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['cost_etsim_round_game'].'" class="cost_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['cost_etsim_round_game'].'"><input type="hidden" name="cost_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['cost_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['benefit_etsim_round_game'].'" class="benefit_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['benefit_etsim_round_game'].'"><input type="hidden" name="benefit_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['benefit_etsim_round_game'].'"></td>';
				echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['ratio'].'" class="benefit_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['ratio'].'"><input type="hidden" name="ratio" value="'.$rowresultstmttableSelectGameResults['ratio'].'"></td>';
				//echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGameResults['capital_etsim_round_game'].'" class="capital_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['capital_etsim_round_game'].'"><input type="hidden" name="capital_etsim_round_game" value="'.$rowresultstmttableSelectGameResults['capital_etsim_round_game'].'"></td></tr>';
			}
			echo "<script>";
			$arrayjs= "roundarray=[";
			for($i=0;$i<sizeof($roundarray);$i++){
				$arrayjs.= $roundarray[$i].',';
			}
			array_pop($arrayjs);
			$arrayjs.='];';
			echo $arrayjs;
			echo "benefarray=[";
			for($i=0;$i<sizeof($benefarray);$i++){
				echo $benefarray[$i];
				if($i<sizeof($benefarray)-1) echo ',';
			}
			echo '];';
			echo "costarray=[";
			for($i=0;$i<sizeof($costarray);$i++){
				echo $costarray[$i];
				if($i<sizeof($costarray)-1) echo ',';
			}
			echo '];';

			echo 'profitarray=[';
			for($i=0;$i<sizeof($profitarray);$i++){
				echo $profitarray[$i];
				if($i<sizeof($profitarray)-1) echo ',';
			}
			echo '];';
			echo 'setUpGraph(roundarray,profitarray,costarray);</script>';
			echo "<h1> capital : $capital</h1>";

		}

		//$stmttableSelectGameResults->close();
	}
	
	function CurrentGamePlants($mysqli, $idGame) {
		$tableSelectPlantMember = "SELECT id_etsim_plant_game_contains FROM can_contains WHERE id_etsim_game = :idEtsimGame AND id_etsim_members = :idEtsimMeber GROUP BY id_etsim_plant_game_contains ORDER BY id_etsim_plant_game_contains;";
		if( $stmttableSelectPlantMemberResults = $mysqli->prepare($tableSelectPlantMember) ) {
            $stmttableSelectPlantMemberResults->bindParam(':idEtsimGame', $idGame);
            $stmttableSelectPlantMemberResults->bindParam(':idEtsimMeber', $_SESSION['user_id']);
			$stmttableSelectPlantMemberResults->execute();
			//$resultstmttableSelectPlantMemberResults = $stmttableSelectPlantMemberResults->get_result();
			$i = 0;
			while($rowresultstmttableSelectPlantMemberResults = $stmttableSelectPlantMemberResults->fetch()) {
				$SelectShowPlant = "SELECT  ep.*,
											etp.*,
											ha.v_costs_etsim_members_have
									FROM etsim_plant ep 
										INNER JOIN is_type it 
											ON ep.id_etsim_plant = it.id_etsim_plant 
										INNER JOIN etsim_type_plant etp 
											ON it.id_etsim_type_plant = etp.id_etsim_type_plant 
										INNER JOIN have ha
											ON ep.id_etsim_plant = ha.id_etsim_plant
									WHERE ep.id_etsim_plant = :idEtsimPlant 
									AND ha.id_etsim_members_have = :idEtsimMemberHave
									GROUP BY ep.id_etsim_plant
									ORDER BY ep.id_etsim_plant;";
				if( $stmtSelectShowPlant = $mysqli->prepare($SelectShowPlant) ) {
					$stmtSelectShowPlant->bindParam(':idEtsimPlant', $rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains']);
                    $stmtSelectShowPlant->bindParam(':idEtsimMemberHave', $_SESSION['user_id']);
					$stmtSelectShowPlant->execute();
					//$resultstmtSelectShowPlant = $stmtSelectShowPlant->get_result();
					while($rowresultstmtSelectShowPlant = $stmtSelectShowPlant->fetch()) {
						echo '<tr><input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="name_etsim_type_plant" value="'.$rowresultstmtSelectShowPlant['name_etsim_type_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="cost_mw_etsim_plant" value="'.$rowresultstmtSelectShowPlant['cost_mw_etsim_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="om_mw_etsim_plant" value="'.$rowresultstmtSelectShowPlant['om_mw_etsim_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="rdt_etsim_plant" value="'.$rowresultstmtSelectShowPlant['rdt_etsim_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="operation_etsim_plant" value="'.$rowresultstmtSelectShowPlant['operation_etsim_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="construction_etsim_plant" value="'.$rowresultstmtSelectShowPlant['construction_etsim_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="minv_costs_etsim_type_plant" value="'.$rowresultstmtSelectShowPlant['minv_costs_etsim_type_plant'].'">
								  <input type="hidden" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" name="maxv_costs_etsim_type_plant" value="'.$rowresultstmtSelectShowPlant['maxv_costs_etsim_type_plant'].'">';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="number_etsim_plant" value="'.$i.'"></td>';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="name_etsim_type_plant" value="'.$rowresultstmtSelectShowPlant['name_etsim_type_plant'].'"><input type="hidden" name="name_etsim_type_plant" value="'.$rowresultstmtSelectShowPlant['name_etsim_type_plant'].'"></td>';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="description_etsim_plant" value="'.$rowresultstmtSelectShowPlant['description_etsim_plant'].'"><input type="hidden" name="description_etsim_plant" value="'.$rowresultstmtSelectShowPlant['description_etsim_plant'].'"></td>';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="nb_unit_etsim_plant" value="'.$rowresultstmtSelectShowPlant['nb_unit_etsim_plant'].'"><input type="hidden" name="nb_unit_etsim_plant" value="'.$rowresultstmtSelectShowPlant['nb_unit_etsim_plant'].'"></td>';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="power_unit_etsim_plant" value="'.$rowresultstmtSelectShowPlant['power_unit_etsim_plant'].'"><input type="hidden" name="power_unit_etsim_plant" value="'.$rowresultstmtSelectShowPlant['power_unit_etsim_plant'].'"></td>';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="fixed_costs_etsim_plant" value="'.$rowresultstmtSelectShowPlant['fixed_costs_etsim_plant'].'"><input type="hidden" name="fixed_costs_etsim_plant" value="'.$rowresultstmtSelectShowPlant['fixed_costs_etsim_plant'].'"></td>';
						echo '<td><input disabled type="text" id="'.$rowresultstmtSelectShowPlant['id_etsim_plant'].'" class="v_costs_etsim_members_have" value="'.$rowresultstmtSelectShowPlant['v_costs_etsim_members_have'].'"><input type="hidden" name="v_costs_etsim_members_have" value="'.$rowresultstmtSelectShowPlant['v_costs_etsim_members_have'].'"></td>';
						$i++;
					}
				} else {
					$error_msg .= "Error create table current plant of user !";
				}
				//$stmtSelectShowPlant->close();
			}
		} else {
			$error_msg .= "Error select id plant !";
		}
		//$stmttableSelectPlantMemberResults->close();
	}

	function GameRoundNumber($mysqli, $idGame) {
		$SelectCountNumber = "SELECT id_etsim_round_game FROM can_contains WHERE id_etsim_game = :idGame AND id_etsim_members = :idUser GROUP BY id_etsim_round_game ORDER BY id_etsim_round_game DESC limit 1;";
		if( $stmtSelectCountNumber = $mysqli->prepare($SelectCountNumber) ) {
            $stmtSelectCountNumber->bindParam(':idGame', $idGame);
            $stmtSelectCountNumber->bindParam(':idUser', $_SESSION['user_id']);
			$stmtSelectCountNumber->execute();
			//$stmtSelectCountNumber->store_result();
			$stmtSelectCountNumber->bindColumn('id_etsim_round_game',$totalCountRound);
			$stmtSelectCountNumber->fetch();
			$totalCountRound = $totalCountRound + 1;
			echo $totalCountRound;
		} else {
			$error_msg .= "Error count round game !";
		}
	}
	
	function InsertRowsRoundGame($mysqli, $idGame, $numberRoundGame, $demand) {
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
						VALUES (:idEtsimGame, :idUser, :nbRound, 1, 1, 1, :demand, 1, 1, 1, 1, 1, :idEtsim, 0);";
		$SelectCountNumber = "SELECT id_etsim_plant_game_contains FROM can_contains WHERE id_etsim_game = :idGame AND id_etsim_members = :idMember GROUP BY id_etsim_round_game ORDER BY id_etsim_round_game DESC limit 1;";
		if( $stmtSelectCountNumber = $mysqli->prepare($SelectCountNumber) ) {
            $stmtSelectCountNumber->bindParam(':idGame', $idGame);
            $stmtSelectCountNumber->bindParam(':idMember', $_SESSION['user_id']);
			$stmtSelectCountNumber->execute();
			//$stmtSelectCountNumber->store_result();
			$stmtSelectCountNumber->bindColumn('id_etsim_plant_game_contains',$id_etsim);
			$stmtSelectCountNumber->fetch();
			//$stmtSelectCountNumber->close();
		}
		if( $stmtinsertRound = $mysqli->prepare($insertRound) ) {
            $stmtinsertRound->bindParam(':idEtsimGame', $idGame);
            $stmtinsertRound->bindParam(':idUser', $_SESSION['user_id']);
            $stmtinsertRound->bindParam(':nbRound', $numberRoundGame);
            $stmtinsertRound->bindParam(':demand', $demand);
            $stmtinsertRound->bindParam(':idEtsim', $id_etsim);
			$stmtinsertRound->execute();
		} else {
			$error_msg .= 'Error insert new rows !';
		}
	}
	
	function SelectRowsTempRound($mysqli, $idGame, $numberRoundGame, $test) {
		$SelectRound = "SELECT  `line_etsim_round_game_temp`, 
								`bid_volume_etsim_round_game_temp`, 
								`bid_price_etsim_round_game_temp` 
						FROM `etsim_round_game_temp` 
						WHERE `idetsimgame_etsim_round_game_temp` = :idGame
						AND `idetsimmember_etsim_round_game_temp` = :userId
						AND `number_etsim_round_game_temp` = :nbRound;";
		if( $stmtSelectRound = $mysqli->prepare($SelectRound) ) {
            $stmtSelectRound->bindParam(':idGame', $idGame);
            $stmtSelectRound->bindParam(':userId', $_SESSION['user_id']);
            $stmtSelectRound->bindParam(':nbRound', $numberRoundGame);
			$stmtSelectRound->execute();
			
			$i = 1;
			while($rowresultstmtSelectRound = $stmtSelectRound->fetch()) {
				echo '<tr><td><input disabled type="number" name="offerInGame" class="line_etsim_round_game_temp" id="'.$rowresultstmtSelectRound['line_etsim_round_game_temp'].'" value="'.$rowresultstmtSelectRound['line_etsim_round_game_temp'].'"/><br></td>';
				echo '<td><input type="number" name="volumeInGame" class="bid_volume_etsim_round_game_temp" id="'.$rowresultstmtSelectRound['line_etsim_round_game_temp'].'" placeholder="500" x-moz-errormessage="VOLUME IS REQUIRED!" required="required" autofocus="autofocus" value="'.$rowresultstmtSelectRound['bid_volume_etsim_round_game_temp'].'"/><br></td>';
				echo '<td><input type="number" name="priceInGame" class="bid_price_etsim_round_game_temp" id="'.$rowresultstmtSelectRound['line_etsim_round_game_temp'].'" placeholder="200" x-moz-errormessage="PRICE IS REQUIRED!" required="required" autofocus="autofocus" value="'.$rowresultstmtSelectRound['bid_price_etsim_round_game_temp'].'"/><br></td>';
				echo '<td><select id="'.$rowresultstmtSelectRound['line_etsim_round_game_temp'].'" class="ListeBoxPlants">';
				$tableSelectPlantMember = "SELECT id_etsim_plant_game_contains FROM can_contains WHERE id_etsim_game = :idGame AND id_etsim_members = :idUser GROUP BY id_etsim_plant_game_contains ORDER BY id_etsim_plant_game_contains;";
				if( $stmttableSelectPlantMemberResults = $mysqli->prepare($tableSelectPlantMember) ) {
					$stmttableSelectPlantMemberResults->bindParam(':idGame', $idGame);
                    $stmttableSelectPlantMemberResults->bindParam(':idUser', $_SESSION['user_id']);
					$stmttableSelectPlantMemberResults->execute();
					//$resultstmttableSelectPlantMemberResults = $stmttableSelectPlantMemberResults->get_result();
					while($rowresultstmttableSelectPlantMemberResults = $stmttableSelectPlantMemberResults->fetch()) {
						$SelectShowPlant = "SELECT  ep.*,
													etp.*,
													ha.v_costs_etsim_members_have
											FROM etsim_plant ep 
												INNER JOIN is_type it 
													ON ep.id_etsim_plant = it.id_etsim_plant 
												INNER JOIN etsim_type_plant etp 
													ON it.id_etsim_type_plant = etp.id_etsim_type_plant 
												INNER JOIN have ha
													ON ep.id_etsim_plant = ha.id_etsim_plant
											WHERE ep.id_etsim_plant = :idEtsimPlant 
											AND ha.id_etsim_members_have = :idMember
											GROUP BY ep.id_etsim_plant
											ORDER BY ep.id_etsim_plant;";
						if( $stmtSelectShowPlant = $mysqli->prepare($SelectShowPlant) ) {
							$stmtSelectShowPlant->bindParam(':idEtsimPlant', $rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains']);
                            $stmtSelectShowPlant->bindParam(':idMember', $_SESSION['user_id']);
							$stmtSelectShowPlant->execute();
                           
							while($rowresultstmtSelectShowPlant = $stmtSelectShowPlant->fetch()) {
                                echo 'Je suis dans la boucle while';
								$plant = $rowresultstmtSelectShowPlant['name_etsim_type_plant'].' - '.$rowresultstmtSelectShowPlant['nb_unit_etsim_plant'].' UNITS - '.$rowresultstmtSelectShowPlant['power_unit_etsim_plant'].'MW';
								$IdPlantO = $rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains'];
								$name[] = $plant;
								$tab1[] = $rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains'];
                                echo 'tab1:'. $tab1[0];
								// echo '<option id="'.$rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains'].'" class="idplant_etsim_round_game_temp">"'.$plant.'"</option>';
							//}
                            
							$SelectIdPlantLine = "	SELECT idplant_etsim_round_game_temp 
														FROM etsim_round_game_temp 
														WHERE idetsimgame_etsim_round_game_temp = :idGame
														AND idetsimmember_etsim_round_game_temp = :idMember
														AND number_etsim_round_game_temp = :nbRoundGame
														AND line_etsim_round_game_temp = :lineEtsim;";
														
							if( $stmtSelectIdPlantLine = $mysqli->prepare($SelectIdPlantLine) ) {
								$stmtSelectIdPlantLine->bindParam(':idGame', $idGame);
                                $stmtSelectIdPlantLine->bindParam(':idMember',$_SESSION['user_id']);
                                $stmtSelectIdPlantLine->bindParam(':nbRoundGame', $numberRoundGame);
                                $stmtSelectIdPlantLine->bindParam(':lineEtsim', $i);
								$stmtSelectIdPlantLine->execute();
								//$stmtSelectIdPlantLine->store_result();
								$stmtSelectIdPlantLine->bindColumn('idplant_etsim_round_game_temp',$IdPlant);
								$stmtSelectIdPlantLine->fetch();
							}
							foreach ($tab1 as $key => $value) {
								foreach ($name as $keyn => $valuen) {
									$value = (int)$value;
									$IdPlant = (int)$IdPlant;
									if ($value != $IdPlant) {
										echo '<option id="'.$value.'" class="idplant_etsim_round_game_temp">"'.$valuen.'"</option>';
									} else {
										echo '<option selected id="'.$value.'" class="idplant_etsim_round_game_temp">"'.$valuen.'"</option>';
									}
								}
							}
							unset($tab1);
							unset($name);
									// $plant .= $IdPlantO.' - '.$IdPlant;
									// if ( $IdPlant == $IdPlantO ) {	
										// echo '<option selected id="'.$rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains'].'" class="idplant_etsim_round_game_temp">"'.$plant.'"</option>';
									// } else {
										// echo '<option id="'.$rowresultstmttableSelectPlantMemberResults['id_etsim_plant_game_contains'].'" class="idplant_etsim_round_game_temp">"'.$plant.'"</option>';
									// }
									// $stmtSelectIdPlantLine->close();
                        }
						} else {
							$error_msg .= "Error create table current plant of user !";
						}
						//$stmtSelectShowPlant->close();
					}
				} else {
					$error_msg .= "Error select id plant !";
				}
				//$stmttableSelectPlantMemberResults->close();
				$i++;
				echo '</select></td></tr>';
			}
			//$resultstmtSelectRound->close();
		} else {
			$error_msg .= 'Error insert new rows !';
		}	
	}
	function getGameStat($idGame){



	}
	function SelectLineRoundGameUser($mysqli, $idGame, $numberRoundGame){
		if ($SelectLineRound = $mysqli->prepare("SELECT line_etsim_round_game_temp FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idGame AND idetsimmember_etsim_round_game_temp = :idUser AND number_etsim_round_game_temp = :nbRound ORDER BY line_etsim_round_game_temp DESC LIMIT 1;")) {
			$SelectLineRound->bindParam(':idGame', $idGame); 
            $SelectLineRound->bindParam(':idUser', $_SESSION['user_id']);  
            $SelectLineRound->bindParam(':nbRound', $numberRoundGame);  
			$SelectLineRound->execute();    // Exécute la déclaration.
			//$SelectLineRound->store_result();
			$SelectLineRound->bindColumn('line_etsim_round_game_temp',$lineround);
			$SelectLineRound->fetch();
			$lineround = $lineround+1;
			return $lineround;
		}
		//$SelectLineRound->close();
	}
	
	function DeleteLineRoundGameUser($mysqli, $idGame, $numberRoundGame){
		if ($SelectLineRound = $mysqli->prepare("SELECT line_etsim_round_game_temp FROM etsim_round_game_temp WHERE idetsimgame_etsim_round_game_temp = :idGame AND idetsimmember_etsim_round_game_temp = :idUser AND number_etsim_round_game_temp = :nbRound ORDER BY line_etsim_round_game_temp DESC LIMIT 1;")) {
			$SelectLineRound->bindParam(':idGame', $idGame); 
            $SelectLineRound->bindParam(':idUser', $_SESSION['user_id']); 
            $SelectLineRound->bindParam(':nbRound', $numberRoundGame); 
			$SelectLineRound->execute();    // Exécute la déclaration.
			//$SelectLineRound->store_result();
			$SelectLineRound->bindColumn('line_etsim_round_game_temp',$lineround);
			$SelectLineRound->fetch();
			return $lineround;
		}
		//$SelectLineRound->close();
	}
	function getMinPrice($idGame){

		//need to query db now

		return 21;
	}
	function getBidPriceAndVolume($mysqli,$idGame,$idround){
		$result=[];
		if($selectBidPriceandVolume=$mysqli->prepare("select idetsimmember_etsim_round_game_temp, line_etsim_round_game_temp,bid_volume_estim_round_game_temp,bid_price_estim_round_game_temp from estim_round_game_temp where idetsimgame_etsim_round_game_temp= :idGame and number_etsim_round_game_temp = :idRound ")){
			$selectBidPriceandVolume->bindParam(':idGame',$idGame);
            $selectBidPriceandVolume->bindParam(':idRound',$idround);
			$selectBidPriceandVolume->execute();
			//$selectBidPriceandVolume->store_result();
			$selectBidPriceandVolume->bindColumn('idetsimmember_etsim_round_game_temp',$result);
			$selectBidPriceandVolume->fetch();
			return $result;
		}
		//$selectBidPriceandVolume->close();
	}
}

?>