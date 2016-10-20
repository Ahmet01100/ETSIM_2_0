<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 22-12-2015
*/
include_once 'db_connect.php';
include_once 'functions.php';
sec_session_start();
 
if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if (isset($_POST['registertypeplant']) && $_POST['registertypeplant'] == 'registertypeplant') {
		if ( (isset($_POST['name_etsim_type_plant']) && !empty($_POST['name_etsim_type_plant'])) && (isset($_POST['description_etsim_type_plant']) && !empty($_POST['description_etsim_type_plant'])) && (isset($_POST['minv_costs_etsim_type_plant']) && !empty($_POST['minv_costs_etsim_type_plant'])) && (isset($_POST['maxv_costs_etsim_type_plant']) && !empty($_POST['maxv_costs_etsim_type_plant']))) {
			// Nettoyez et validez les données transmises au script
			$nameplant = $_POST['name_etsim_type_plant'];
			$descriptionplant = $_POST['description_etsim_type_plant'];
			$min = $_POST['minv_costs_etsim_type_plant'];
			$max = $_POST['maxv_costs_etsim_type_plant'];

			if (empty($error_msg)) {
				if ($insert_stmt = $mysqli->prepare("INSERT INTO etsim_type_plant (name_etsim_type_plant, description_etsim_type_plant, minv_costs_etsim_type_plant, maxv_costs_etsim_type_plant) VALUES (?, ?, ?, ?)")) {
					$insert_stmt->bind_param('ssss',$nameplant, $descriptionplant, $min, $max);		
					$insert_stmt->execute();
					$insert_stmt->close();
					$success_msg .= '<p class="error">Your type plant has been created !</p>';
				} else {
					$error_msg .= '<p class="error">Your type plant hasn t been created !</p>';
				}
			}
			if (empty($error_msg)) {
				echo '<SCRIPT>javascript:window.close()</SCRIPT>';
			}
		}
	}
}

?>