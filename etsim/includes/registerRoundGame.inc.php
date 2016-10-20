<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 22-12-2015
*/
include_once 'db_connect.php';
if(!isset($_SESSION))
    sec_session_start();
$error_msg = "";

if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Player') {
	if (isset($_POST['register_round']) && $_POST['register_round'] == 'register_round') {
		if ( (isset($_POST['idetsimgame_etsim_round_game']) && !empty($_POST['idetsimgame_etsim_round_game'])) 
			&& (isset($_POST['idetsimmember_etsim_round_game']) && !empty($_POST['idetsimmember_etsim_round_game'])) 
			&& (isset($_POST['number_etsim_round_game_temp']) && !empty($_POST['number_etsim_round_game_temp'])) 
			&& (isset($_POST['bid_volume_etsim_round_game_temp']) && !empty($_POST['bid_volume_etsim_round_game_temp'])) 
			&& (isset($_POST['bid_price_etsim_round_game_temp']) && !empty($_POST['bid_price_etsim_round_game_temp'])) 
			&& (isset($_POST['demand_volume_etsim_round_game_temp']) && !empty($_POST['demand_voume_etsim_round_game_temp'])) 
			&& (isset($_POST['market_price_etsim_round_game_temp']) && !empty($_POST['market_price_etsim_round_game_temp'])) 
			&& (isset($_POST['income_etsim_round_game_temp']) && !empty($_POST['income_etsim_round_game_temp'])) 
			&& (isset($_POST['cost_etsim_round_game_temp']) && !empty($_POST['cost_etsim_round_game_temp'])) 
			&& (isset($_POST['benefit_etsim_round_game_temp']) && !empty($_POST['benefit_etsim_round_game_temp'])) 
			&& (isset($_POST['capital_etsim_round_game_temp']) && !empty($_POST['capital_etsim_round_game_temp']))  ) {
			// Nettoyez et validez les données transmises au script
			$idGame = $_POST['idetsimgame_etsim_round_game'];
			$idM = $_POST['idetsimmember_etsim_round_game'];
			$numRound = $_POST['number_etsim_round_game_temp'];
			$bidV = $_POST['bid_volume_etsim_round_game_temp'];
			$bidP = $_POST['bid_price_etsim_round_game_temp'];
			$demV = $_POST['demand_volume_etsim_round_game_temp'];
			$markP = $_POST['market_price_etsim_round_game_temp'];
			$inco = $_POST['income_etsim_round_game_temp'];
			$cost = $_POST['cost_etsim_round_game_temp'];
			$benef = $_POST['benefit_etsim_round_game_temp'];
			$cap = $_POST['capital_etsim_round_game_temp'];
		}
	}
}
?>