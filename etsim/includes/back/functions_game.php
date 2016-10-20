<?php
include_once 'psl-config.php';

function createTableGame($mysqli) {
	$tableSelectGame = "SELECT * FROM etsim_game";
	$stmttableSelectGame = $mysqli->prepare($tableSelectGame);
	$stmttableSelectGame->execute();
	$resultstmttableSelectGame = $stmttableSelectGame->get_result();
	
	while($rowresultstmttableSelectGame = $resultstmttableSelectGame->fetch_assoc()) {
		echo '<tr id="'.$rowresultstmttableSelectGame['id_etsim_game'].'">';
		echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="id_etsim_game" value="'.$rowresultstmttableSelectGame['id_etsim_game'].'"></td>';
		echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectGame['date_etsim_game'].'" class="date_etsim_game" value="'.$rowresultstmttableSelectGame['date_etsim_game'].'"></td>';
		echo '<td><input type="text" id="'.$rowresultstmttableSelectGame['description_etsim_game'].'" class="description_etsim_game" value="'.$rowresultstmttableSelectGame['description_etsim_game'].'"></td>';
		echo '<td><select multiple="multiple" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="ListeBoxUsersContains">'; 
		$sql_usersin = "SELECT em.id_etsim_members, em.username_etsim_members, eg.id_etsim_game FROM etsim_members em INNER JOIN can_contains cc ON em.id_etsim_members = cc.id_etsim_members INNER JOIN etsim_game eg ON cc.id_etsim_game = eg.id_etsim_game WHERE eg.id_etsim_game = ? GROUP BY em.id_etsim_members ORDER BY em.id_etsim_members";
		if ($stmtListeBoxUsersContains = $mysqli->prepare($sql_usersin)) {
			$stmtListeBoxUsersContains->bind_param('s',$rowresultstmttableSelectGame['id_etsim_game']);
			$stmtListeBoxUsersContains->execute();
			$resultListeBoxUsersContains = $stmtListeBoxUsersContains->get_result();

			while($rowresultListeBoxUsersContains = $resultListeBoxUsersContains->fetch_assoc()) {
				$user = $rowresultListeBoxUsersContains['id_etsim_members'].' | '.$rowresultListeBoxUsersContains['username_etsim_members'];
				echo '<option id="'.$rowresultListeBoxUsersContains['id_etsim_members'].'" value="'.$user.'" class="id_etsim_members">"'.$user.'"</option>';
			}
		} else {
			$error_msg .= "je fais de la merde";
		}

		echo '</select>';
		echo '</td><td>';
		echo '<select multiple="multiple" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="ListeBoxUsersNotContains">';
		$sql_userout = "SELECT em.id_etsim_members, em.username_etsim_members FROM etsim_members em WHERE NOT EXISTS (SELECT * FROM can_contains cc WHERE em.id_etsim_members = cc.id_etsim_members AND cc.id_etsim_game = ?)";
		if ($stmtListeBoxUsersNotContains = $mysqli->prepare($sql_userout)) {
			$stmtListeBoxUsersNotContains->bind_param('s',$rowresultstmttableSelectGame['id_etsim_game']);
			$stmtListeBoxUsersNotContains->execute();
			$resultstmtListeBoxUsersNotContains = $stmtListeBoxUsersNotContains->get_result();

			while($rowresultstmtListeBoxUsersNotContains = $resultstmtListeBoxUsersNotContains->fetch_assoc()) {
				$user = $rowresultstmtListeBoxUsersNotContains['id_etsim_members'].' | '.$rowresultstmtListeBoxUsersNotContains['username_etsim_members'];
				echo '<option id="'.$rowresultstmtListeBoxUsersNotContains['id_etsim_members'].'" class="id_etsim_members"  value="'.$user.'">"'.$user.'"</option>';
			}
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
		echo '</select></td>';
		echo '<td><button type="button" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="viewgame_etsim_game" />VIEW</button></td>';
		echo '<td><button type="button" id="'.$rowresultstmttableSelectGame['id_etsim_game'].'" class="delete_etsim_game">Delete</button></td></tr>';
	}
	$resultstmtListeBoxUsersNotContains->close();
	$resultListeBoxUsersContains->close();
	$resultstmttableSelectGame->close();
}

function createTablePlant($mysqli){
	$tableSelectPlant = "SELECT * FROM etsim_plant ep INNER JOIN is_type it ON ep.id_etsim_plant = it.id_etsim_plant INNER JOIN etsim_type_plant etp ON it.id_etsim_type_plant = etp.id_etsim_type_plant;";
	if ($stmttableSelectPlant = $mysqli->prepare($tableSelectPlant)) {
		$stmttableSelectPlant->execute();
		$resultstmttableSelectPlant = $stmttableSelectPlant->get_result();
	
		while($rowresultstmttableSelectPlant = $resultstmttableSelectPlant->fetch_assoc()) {
			echo '<tr id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'">';
			echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="id_etsim_plant" value="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'"></td>';
			echo '<td><select id="'.$rowresultstmttableSelectPlant['id_etsim_plant'].'" class="name_etsim_type_plant">'; 
			$tableSelectTypePlant = "SELECT * FROM etsim_type_plant;";
			if ($stmttableSelectTypePlant = $mysqli->prepare($tableSelectTypePlant)) {
				$stmttableSelectTypePlant->execute();
				$resultstmttableSelectTypePlant = $stmttableSelectTypePlant->get_result();
				while($rowresultstmttableSelectTypePlant = $resultstmttableSelectTypePlant->fetch_assoc()) {
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
	$stmttableSelectPlant->close();
	$stmttableSelectTypePlant->close();
}

function createTableTypePlant($mysqli){
	$tableSelectTypePlant = "SELECT * FROM etsim_type_plant;";
	if ($stmttableSelectTypePlant = $mysqli->prepare($tableSelectTypePlant)) {
		$stmttableSelectTypePlant->execute();
		$resultstmttableSelectTypePlant = $stmttableSelectTypePlant->get_result();
	
		while($rowresultstmttableSelectTypePlant = $resultstmttableSelectTypePlant->fetch_assoc()) {
			echo '<tr id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'">';
			echo '<td><input disabled type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="id_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'"></td>';
			echo '<td><input type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="name_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['name_etsim_type_plant'].'"></td>';
			echo '<td><input type="text" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="description_etsim_type_plant" value="'.$rowresultstmttableSelectTypePlant['description_etsim_type_plant'].'"></td>';
			echo '<td><button type="button" id="'.$rowresultstmttableSelectTypePlant['id_etsim_type_plant'].'" class="delete_etsim_type_plant">Delete</button></td></tr>';
		}
	} else {
		$error_msg .= "Error DB access : etsim_type_type_plant";
	}
	$resultstmttableSelectTypePlant->close();
}
?>