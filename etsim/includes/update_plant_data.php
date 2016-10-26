<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 02-11-2015
*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	if(!isset($_SESSION))
        sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if(isset($_GET['plant_id']) && isset($_GET['tplant_id'])) {
		if ($updateidtypeplant = $mysqli->prepare("UPDATE is_type SET id_etsim_type_plant = ".$_GET['tplant_id']." WHERE id_etsim_plant = ".$_GET['plant_id'].";")) {  
			$updateidtypeplant->execute();
		} else {
			$error_msg .= "Error Update to DB is_type !";
		}	
		//$updateidtypeplant->close();
	}
	
	if(isset($_GET['id']) && isset($_GET['col']) && isset($_GET['val'])) {
		if ($updatenameplant = $mysqli->prepare("UPDATE etsim_plant SET ".$_GET['col']." = \"".$_GET['val']."\" WHERE id_etsim_plant = ".$_GET['id'].";")) {  
			$updatenameplant->execute();
		} else {
			$error_msg .= "Error Update to DB etsim_plant !";
		}	
		//$updatenameplant->close();
	}
	
	if (isset($_GET['id_plant']) && isset($_GET['colo']) && isset($_GET['delete'])) {
		if ($selectExistsP = $mysqli->prepare("SELECT * FROM is_type WHERE id_etsim_plant = :idPlant")) {
			$selectExistsP->bindParam(':idPlant', $_GET['id_plant']);  
			$selectExistsP->execute();
			//$resultselectExistsP = $selectExistsP->get_result();
			while($rowresultselectExistsP = $selectExistsP->fetch()) {
				$row_idP = $rowresultselectExistsP['id_etsim_plant'];
			}
			if ( $row_idP == $_GET['id_plant'] ) {
				$deletegameIS = $mysqli->prepare("DELETE FROM is_type WHERE id_etsim_plant = :idPlant;");
				$deletegameIS->bindParam(':idPlant', $_GET['id_plant']);  
				$deletegameIS->execute();
				$deletegameP = $mysqli->prepare("DELETE FROM etsim_plant WHERE id_etsim_plant = :idPlant;");
				$deletegameP->bindParam(':idPlant', $_GET['id_plant']);  
				$deletegameP->execute();
				/*$deletegameP->close();
				$deletegameIS->close();*/
				$resetPlant = $mysqli->prepare("ALTER TABLE etsim_plant AUTO_INCREMENT = 1;");
				$resetPlant->execute();
				//$resetPlant->close();
				return true;
			} else {
				$deletegameP = $mysqli->prepare("DELETE FROM etsim_plant WHERE id_etsim_plant = :idPlant;");
				$deletegameP->bindParam(':idPlant', $_GET['id_plant']);  
				$deletegameP->execute();
				//$deletegameP->close();
				$resetPlant = $mysqli->prepare("ALTER TABLE etsim_plant AUTO_INCREMENT = 1;");
				$resetPlant->execute();
				//$resetPlant->close();
				return true;
			}
		} else {
			$error_msg .= "error select is_type";
		}
	}
}
?>