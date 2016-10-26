<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 20-10-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	if(!isset($_SESSION))
        sec_session_start();

if ($_SESSION['role'] == "Admin") {
	if(isset($_GET['id']) && isset($_GET['col']) && isset($_GET['val'])){
		$query="UPDATE etsim_members SET ".$_GET['col']." = \"".$_GET['val']."\" WHERE id_etsim_members = ".$_GET['id'].";";
		$stmt = $mysqli->prepare($query);
		$stmt->execute();
		if ( $_GET['col'] == "enable_etsim_members" ) {
			$select="SELECT username_etsim_members
							   ,email_etsim_members
						FROM etsim_members
						WHERE id_etsim_members = ".$_GET['id'].";";
			if ($result = $mysqli->query($select)) {
				while($obj = $result->fetch()) {
					$username = $obj["username_etsim_members"];
					$email = $obj["email_etsim_members"];
				}
			} else {
				printf("Invalid query: %s\nWhole query: %s\n", $mysqli->error, $SQL);
				exit();
			}
			if ($deleteloginattempts = $mysqli->prepare("DELETE FROM etsim_login_attempt WHERE user_id_login_attempt = :idUser")) {
						//echo "Echec de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
						//echo 'Vérouillé';
						$deleteloginattempts->bindParam(':idUser', $_GET['id']);  // Lie "$email" aux paramètres.
						$deleteloginattempts->execute();    // Exécute la déclaration.
						//$deleteloginattempts->close();
			}
			if ( $_GET['val'] == "1" ) {		
				$message = "Your account $username has been activated on ETSIM Serious GAME.";
				$subject = "Activating your account : $username";
				$header = "From: etsim.serious-game@utbm.fr";
				mail($email,$subject,$message,$header);
			} else {
				$message = "Your account $username has been disabled on ETSIM Serious GAME.";
				$subject = "Disabling your account : $username";
				$header = "From: etsim.serious-game@utbm.fr";
				mail($email,$subject,$message,$header);
			}
		}
		/*$stmt->close();
		$result->close();
		$mysqli->close();*/
		return true;
	}
	
	if(isset($_GET['id']) && isset($_GET['delete'])){
		$select="SELECT username_etsim_members
							   ,email_etsim_members
						FROM etsim_members
						WHERE id_etsim_members = ".$_GET['id'].";";
		if ($result = $mysqli->query($select)) {
			while($obj = $result->fetch()) {
				$username = $obj["username_etsim_members"];
				$email = $obj["email_etsim_members"];
			}
		}
		$message = "Your account $username has been deleted on ETSIM Serious GAME.";
		$subject = "Deleting your account : $username";
		$header = "From: etsim.serious-game@utbm.fr";
		mail($email,$subject,$message,$header);
		$query="DELETE FROM etsim_members WHERE id_etsim_members = ".$_GET['id'].";";
		$stmt = $mysqli->prepare($query);
		$stmt->execute();
		//$result->close();
		//$stmt->close();
		//$mysqli->close();
		$resetUser = $mysqli->prepare("ALTER TABLE etsim_members AUTO_INCREMENT = 1;");
		$resetUser->execute();
		//$resetUser->close();
		return true;
	}
}
?>