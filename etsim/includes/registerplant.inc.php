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
 
if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if (isset($_POST['registerplant']) && $_POST['registerplant'] == 'registerplant') {
		if ( (isset($_POST['name_etsim_game']) && !empty($_POST['name_etsim_game'])) && (isset($_POST['nb_unit_etsim_plant']) && !empty($_POST['nb_unit_etsim_plant'])) && (isset($_POST['power_unit_etsim_plant']) && !empty($_POST['power_unit_etsim_plant'])) && (isset($_POST['cost_mw_etsim_plant']) && !empty($_POST['cost_mw_etsim_plant'])) && (isset($_POST['om_mw_etsim_plant']) && !empty($_POST['om_mw_etsim_plant'])) && (isset($_POST['rdt_etsim_plant']) && !empty($_POST['rdt_etsim_plant'])) && (isset($_POST['construction_etsim_plant']) && !empty($_POST['construction_etsim_plant'])) && (isset($_POST['operation_etsim_plant']) && !empty($_POST['operation_etsim_plant'])) && (isset($_POST['description_etsim_plant']) && !empty($_POST['description_etsim_plant'])) ) {
			// Nettoyez et validez les données transmises au script
			$nameplant = $_POST['name_etsim_game'];
			$numberunit = $_POST['nb_unit_etsim_plant'];
			$poweruunit = $_POST['power_unit_etsim_plant'];
			$costmw = $_POST['cost_mw_etsim_plant'];
			$ommw = $_POST['om_mw_etsim_plant'];
			$rdt = $_POST['rdt_etsim_plant'];
			$construction = $_POST['construction_etsim_plant'];
			$operation = $_POST['operation_etsim_plant'];
			$descPlant = $_POST['description_etsim_plant'];
			$fixedCosts = ($numberunit * $ommw * $poweruunit);

			if (empty($error_msg)) {
				$sqlinsert = "INSERT INTO etsim_plant (nb_unit_etsim_plant, power_unit_etsim_plant, cost_mw_etsim_plant, om_mw_etsim_plant, rdt_etsim_plant, construction_etsim_plant, operation_etsim_plant, fixed_costs_etsim_plant, description_etsim_plant) VALUES ($numberunit, $poweruunit, $costmw, $ommw, $rdt, $construction, $operation, $fixedCosts, $descPlant);";
				if ( $insert_stmt = $mysqli->prepare($sqlinsert) ) {
					$insert_stmt->execute();
					$success_msg = '<p class="error">Your type plant has been created !</p>';
					$sqlselectplantid = "SELECT id_etsim_plant FROM etsim_plant ORDER BY id_etsim_plant DESC LIMIT 0, 1;";
					$sqlselecttypeplantid = "SELECT id_etsim_type_plant FROM etsim_type_plant WHERE name_etsim_type_plant = '$nameplant';";
					if ( $selectPlantId_stmt = $mysqli->prepare($sqlselectplantid) ) {
						$selectPlantId_stmt->execute();
						//$resultselectPlantId_stmt = $selectPlantId_stmt->get_result();
						while($rowresultselectPlantId_stmt = $selectPlantId_stmt->fetch()) {
							echo $IdPlant = $rowresultselectPlantId_stmt['id_etsim_plant'];
						}
						if ( $addFixedCosts = $mysqli->prepare("UPDATE etsim_plant SET fixed_costs_etsim_plant = nb_unit_etsim_plant*om_mw_etsim_plant*power_unit_etsim_plant WHERE id_etsim_plant = :idPlant;") ) {
							$addFixedCosts->bindParam(':idPlant', $IdPlant);
							$addFixedCosts->execute();
						} else {
							$error_msg .= '<p class="error"> Error create fixed costs !</p>';
						}
						//$selectPlantId_stmt->close();
					} else {
						$error_msg .= '<p class="error">ID PLANT not found !</p>';
					}
					if ( $selectTypePlantId_stmt = $mysqli->prepare($sqlselecttypeplantid) ) {
						$selectTypePlantId_stmt->execute();
						//$resultselectTypePlantId_stmt = $selectTypePlantId_stmt->get_result();
						while($rowresultselectTypePlantId_stmt = $selectTypePlantId_stmt->fetch()) {
							echo $IdTypePlant = $rowresultselectTypePlantId_stmt['id_etsim_type_plant'];
						}
						//$selectTypePlantId_stmt->close();
					} else {
						$error_msg .= '<p class="error">ID TYPE PLANT not found !</p>';
					}
					$insert_plantid_typeplant_id = "INSERT INTO is_type (id_etsim_plant, id_etsim_type_plant) VALUES ($IdPlant, $IdTypePlant);";
					if ( $insert_plantid_typeplant_id_stmt = $mysqli->prepare($insert_plantid_typeplant_id) ) {
						$insert_plantid_typeplant_id_stmt->execute();
						//$insert_plantid_typeplant_id_stmt->close();
					} else {
						$error_msg .= '<p class="error">ERROR insert is_type id_etsim_plant & id_etsim_type_plant !</p>';
					}
					//$insert_stmt->close();	
				} else {
					$error_msg .= '<p class="error">Your plant hasn t been created !</p>';
				}
			}
			if (empty($error_msg)) {
				//echo '<SCRIPT>javascript:window.close()</SCRIPT>';
			}
		}
	}
}

?>