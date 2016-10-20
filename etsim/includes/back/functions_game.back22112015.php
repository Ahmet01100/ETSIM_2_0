<?php
include_once 'psl-config.php';

function createTableGame($mysqli, $sql_query) {
	$stmt = $mysqli->prepare($sql_query);
	$stmt->execute();
	$result = $stmt->get_result();
	echo '<option value="$game" selected>Select game!</option>';
	
	while($row = $result->fetch_assoc()) {
		$game = $row['id_etsim_game'].' | '.$row['date_etsim_game'].' | '.$row['description_etsim_game'];
		echo '<option id="'.$row['id_etsim_game'].'" value="$game">"'.$game.'"</option>';
	}
}

function createListeBoxUsers($mysqli, $id_game, $sql_query) {
	if ($stmt = $mysqli->prepare($sql_query)) {
		$stmt->bind_param('s',$id_game);
		$stmt->execute();
		$result = $stmt->get_result();

		while($row = $result->fetch_assoc()) {
			$user = $row['id_etsim_members'].' | '.$row['username_etsim_members'];
			echo '<option id="'.$row['id_etsim_members'].'" value="$user">"'.$user.'"</option>';
		}
		$result->close();
	} else {
		$error_msg .= "je fais de la merde";
	}
}
?>