<?php
	/*
	* Created by : bryan.maisano@gmail.com
	* For add new plant
	* date * 12-10-2015
	*/
	include_once 'db_connect.php';
	include_once 'functions.php';
	
	$stmtSelectPlant = $mysqli->prepare("SELECT * FROM etsim_plant;");
	$stmtSelectPlant->execute();
	$resultstmtSelectPlant = $stmtSelectPlant->get_result();	
	while($rowresultstmtSelectPlant = $resultstmtSelectPlant->fetch_assoc()) {
		$id = $rowresultstmtSelectPlant['id_etsim_plant'];
		$nb = $rowresultstmtSelectPlant['nb_unit_etsim_plant'];
		$pow = $rowresultstmtSelectPlant['power_unit_etsim_plant'];
		$cost = $rowresultstmtSelectPlant['cost_mw_etsim_plant'];
		$om = $rowresultstmtSelectPlant['om_mw_etsim_plant'];
		$rdt = $rowresultstmtSelectPlant['rdt_etsim_plant'];
		$cons = $rowresultstmtSelectPlant['construction_etsim_plant'];
		$ope = $rowresultstmtSelectPlant['operation_etsim_plant'];
		$fix = $rowresultstmtSelectPlant['fixed_costs_etsim_plant'];
		$desc = $rowresultstmtSelectPlant['description_etsim_plant'];
		$nnb = $nb + 1;
		for ( $i = 0 ; $i < 3 ; $i++ ) {
			$npow = $nnb * $pow;
			$nfost = $nnb * $om * $pow;
			$ndesc = "$desc $nnb UNITS";
			echo $sql = "INSERT INTO etsim_plant (nb_unit_etsim_plant, power_unit_etsim_plant, cost_mw_etsim_plant, om_mw_etsim_plant, rdt_etsim_plant, construction_etsim_plant, operation_etsim_plant, fixed_costs_etsim_plant, description_etsim_plant) VALUES ($nnb, $npow, $cost, $om, $rdt, $cons, $ope, $nfost, '$ndesc');";
			if ($insertstmtSelectPlant = $mysqli->prepare($sql)) {
				$insertstmtSelectPlant->execute();	
			} else {
				echo 'errroor';
			}
			
			$nnb = $nnb + 1;	
		}
		$insertstmtSelectPlant->close();
	}
?>