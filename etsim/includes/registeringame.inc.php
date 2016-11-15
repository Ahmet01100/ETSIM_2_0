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
	if(isset($_GET['jgame_id']) && isset($_GET['jpassword']) ) {
		echo $idgame = $_GET['jgame_id'];
		echo $password = $_GET['jpassword'];
		echo $memberID = $_SESSION['user_id'];
		
		if ($stmtSelectGame = $mysqli->prepare("	SELECT id_etsim_game
											   ,password_etsim_game
											   ,salt_etsim_game
										FROM etsim_game
										WHERE id_etsim_game = :idGame
										LIMIT 1")) {
			//echo "Echec de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
			$stmtSelectGame->bindParam(':idGame', $idgame);  
			$stmtSelectGame->execute();    // Exécute la déclaration.
			//$stmtSelectGame->store_result();
	 
			// Récupère les variables dans le résultat
			$stmtSelectGame->bindColumn('id_etsim_game',$game_id);
            $stmtSelectGame->bindColumn('password_etsim_game',$game_db_password);
            $stmtSelectGame->bindColumn('salt_etsim_game',$game_salt);
			$stmtSelectGame->fetch();
			$game_salt = trim($game_salt);
			# Crée un IV aléatoire à utiliser avec l'encodage CBC
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);	
			$ciphertext_dec = base64_decode($game_db_password);
			# Récupère le IV, iv_size doit avoir été créé en utilisant la fonction
			# mcrypt_get_iv_size()
			$iv_dec = substr($ciphertext_dec, 0, $iv_size);
			
			# Récupère le texte du cipher (tout, sauf $iv_size du début)
			$ciphertext_dec = substr($ciphertext_dec, $iv_size);

			# On doit supprimer les caractères de valeur 00h de la fin du texte plein
			$decryptgamepassword = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $game_salt, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
			
			if ( trim($password) == trim($decryptgamepassword) ) {
				$round = "0";
				if ($stmtSelectCountPLant = $mysqli->prepare("SELECT count(*) as totalPlant FROM etsim_plant;")) {
					$stmtSelectCountPLant->execute();
					//$stmtSelectCountPLant->store_result();
					$stmtSelectCountPLant->bindColumn('totalPlant',$totalCount);
					$stmtSelectCountPLant->fetch();
					$stack = array();
					for($z=0;$z<5;$z++) {
						$randomIndex = rand(1,$totalCount);
						while (in_array($randomIndex, $stack, true)) {
							$randomIndex = rand(1,$totalCount);
						}
						if ($stmtInsertUserGame = $mysqli->prepare("INSERT INTO can_contains (id_etsim_plant_game_contains, id_etsim_game, id_etsim_members, id_etsim_round_game) VALUES (:randIndex, :idGame, :idMember, :idRound);")) {
							$stmtInsertUserGame->bindParam(':randIndex', $randomIndex); 
                            $stmtInsertUserGame->bindParam(':idGame', $idgame); 
                            $stmtInsertUserGame->bindParam(':idMember', $memberID); 
                            $stmtInsertUserGame->bindParam(':idRound', $round); 
							$stmtInsertUserGame->execute();
							if ($selectinfoPlant = $mysqli->prepare("SELECT ep.rdt_etsim_plant, etp.minv_costs_etsim_type_plant, etp.maxv_costs_etsim_type_plant
																	 FROM etsim_plant ep
																	 INNER JOIN is_type it
																		ON ep.id_etsim_plant = it.id_etsim_plant
																	 INNER JOIN etsim_type_plant etp
																		ON it.id_etsim_type_plant = etp.id_etsim_type_plant 
																	 WHERE ep.id_etsim_plant = :idPlant;")) {
								$selectinfoPlant->bindParam(':idPlant', $randomIndex);
								$selectinfoPlant->execute();
								//$selectinfoPlant->store_result();
                                $selectinfoPlant->bindColumn('rdt_etsim_plant',$rdt);
                                $selectinfoPlant->bindColumn('minv_costs_etsim_type_plant',$minc);
                                $selectinfoPlant->bindColumn('maxv_costs_etsim_type_plant',$maxc);
								
								$selectinfoPlant->fetch();
								if ( $minc == $maxc ) {
									$varCost =  ($maxc/$rdt);
								} else {
									$randc = rand($minc,$maxc);
									$varCost = ($randc/$rdt);
								}
								if ($stmtInsertVcost = $mysqli->prepare("INSERT INTO have (id_etsim_members_have, v_costs_etsim_members_have, id_etsim_plant, id_etsim_game) VALUES (:idMember, :vCost, :idPlant, :idGame);")) {
									$stmtInsertVcost->bindParam(':idMember', $memberID);
                                    $stmtInsertVcost->bindParam(':vCost', $varCost);
                                    $stmtInsertVcost->bindParam(':idPlant', $randomIndex);
                                    $stmtInsertVcost->bindParam(':idGame', $idgame);
									$stmtInsertVcost->execute();
									//s$stmtInsertVcost->close();
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
				/*$stmtSelectCountPLant->close();
				$stmtInsertUserGame->close();
				$selectinfoPlant->close();*/
			} else {
				echo "FAUX";
				$error_msg .= "Error password !";
			}
		} else {
			echo "Error";
		}
	}
}

?>