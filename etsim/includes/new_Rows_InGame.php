<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 07-11-2015
*/
include_once 'functions.php';
if(!isset($_SESSION))
    sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player" ) {
	function newRowsInGame() {
		echo '<tr>
		<input type="hidden" name="register_round" value="register_round"/>
		<input type="hidden" name="validate_etsim_round_game" value="true">
		<input type="hidden" name="idetsimgame_etsim_round_game" value="<?php echo $idGame ?>">
		<input type="hidden" name="idetsimmember_etsim_round_game" value="<?php echo $Uid ?>">
		<input type="hidden" name="number_etsim_round_game_temp" value="<?php GameRoundNumber($mysqli, $idGame); ?>">
		<td>
		<input disabled type="number" name="offerInGame" id="offerInGame" value="<?php $o = 1; echo $o;?>"/><br>
		</td>
		<td>
		<input type="number" name="volumeInGame" id="volumeInGame" placeholder="500" x-moz-errormessage="VOLUME IS REQUIRED!" required="required" autofocus="autofocus" value="0"/><br>
		</td>
		<td>
		<input type="number" name="priceInGame" id="priceInGame" placeholder="200" x-moz-errormessage="PRICE IS REQUIRED!" required="required" autofocus="autofocus" value="0"/><br>
		</td>
		<td>
		<select id="ListeBoxPlants" class="ListeBoxPlants">
		<?php SelectCurrentGamePlants($mysqli, $idGame); ?>
		</td>
		</tr>';
	}
}
?>