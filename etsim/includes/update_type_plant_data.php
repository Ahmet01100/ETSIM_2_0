<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 02-11-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if(isset($_GET['id']) && isset($_GET['col']) && isset($_GET['val'])) {
		if ($updatetypeplant = $mysqli->prepare("UPDATE etsim_type_plant SET ".$_GET['col']." = \"".$_GET['val']."\" WHERE id_etsim_type_plant = ".$_GET['id'].";")) {  
			$updatetypeplant->execute();
		} else {
			$error_msg .= "Error Update to DB etsim_plant !";
		}	
		$updatetypeplant->close();
	}
	 
	if(isset($_GET['id_type_plant']) && isset($_GET['colo']) && isset($_GET['delete'])){
		if ($selectExistsTP = $mysqli->prepare("SELECT * FROM is_type WHERE id_etsim_type_plant = ?")) {
			$selectExistsTP->bind_param('s', $_GET['id_type_plant']);  
			$selectExistsTP->execute();
			$resultselectExistsTP = $selectExistsTP->get_result();
			while($rowresultselectExistsTP = $resultselectExistsTP->fetch_assoc()) {
				$row_idTP = $rowresultselectExistsTP['id_etsim_type_plant'];
			}
			if ( $row_idTP == $_GET['id_type_plant'] ) {
				$deletegameIS = $mysqli->prepare("DELETE FROM is_type WHERE id_etsim_type_plant = ?;");
				$deletegameIS->bind_param('s', $_GET['id_type_plant']);  
				$deletegameIS->execute();
				$deletegameP = $mysqli->prepare("DELETE FROM etsim_type_plant WHERE id_etsim_type_plant = ?;");
				$deletegameP->bind_param('s', $_GET['id_type_plant']);  
				$deletegameP->execute();
				$deletegameP->close();
				$deletegameIS->close();
				$resetTPlant = $mysqli->prepare("ALTER TABLE etsim_type_plant AUTO_INCREMENT = 1;");
				$resetTPlant->execute();
				$resetTPlant->close();
				return true;
			} else {
				$deletegameP = $mysqli->prepare("DELETE FROM etsim_type_plant WHERE id_etsim_type_plant = ?;");
				$deletegameP->bind_param('s', $_GET['id_type_plant']);  
				$deletegameP->execute();
				$deletegameP->close();
				$resetTPlant = $mysqli->prepare("ALTER TABLE etsim_type_plant AUTO_INCREMENT = 1;");
				$resetTPlant->execute();
				$resetTPlant->close();
				return true;
			}
		} else {
			$error_msg .= "error select is_type";
		}
	}
}
?>