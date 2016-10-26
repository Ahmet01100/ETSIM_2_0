<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 12-10-2015
*/
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
	include_once 'includes/functions_game.php';
	include_once 'includes/registerplant.inc.php';
	if(!isset($_SESSION))
        sec_session_start();
	
	if (!empty($error_msg)) {
		echo $error_msg;
	}	
?>

<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>ADD NEW PLANT</h2>
									</header>
										<fieldset><legend>Details</legend>
											<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
												<input type="hidden" name="registerplant" value="registerplant"/>
													<table>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">TYPE</label>
															</td>
															<td>
																<select id="name_etsim_game" name="name_etsim_game" type="text" class="forminput" />
																<?php createSelectTypePlant($mysqli); ?>
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">NUMBER OF UNIT</label>
															</td>
															<td>
																<input id="nb_unit_etsim_plant" name="nb_unit_etsim_plant" type="number" step="0.001" class="nb_unit_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">POWER UNIT</label>
															</td>
															<td>
																<input id="power_unit_etsim_plant" name="power_unit_etsim_plant" type="number" step="0.001" class="power_unit_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">COST UNIT</label>
															</td>
															<td>
																<input id="cost_mw_etsim_plant" name="cost_mw_etsim_plant" type="number" step="0.001" class="cost_mw_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">OM MW</label>
															</td>
															<td>
																<input id="om_mw_etsim_plant" name="om_mw_etsim_plant" type="number" step="0.001" class="om_mw_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">RDT</label>
															</td>
															<td>
																<input id="rdt_etsim_plant" name="rdt_etsim_plant" type="number" step="0.001" class="rdt_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">CONSTRUCTION</label>
															</td>
															<td>
																<input id="construction_etsim_plant" name="construction_etsim_plant" type="number" step="0.001" class="construction_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">OPERATION</label>
															</td>
															<td>
																<input id="operation_etsim_plant" name="operation_etsim_plant" type="number" step="0.001" class="operation_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_plant" class="formlabel">DESCRIPTION PLANT</label>
															</td>
															<td>
																<input id="description_etsim_plant" name="description_etsim_plant" type="text" step="0.001" class="description_etsim_plant">
															</td>
														</tr>
														<tr>
															<td>
																<div id="divlogin">
																	<input type="submit" name="commitNewPlant" value="ADD">
																</div>
															</td>
														</tr>
													</table>
											</form>
										</fieldset>
								</article>
							</div>
						</header>
					</div>
</section>
<?php endif; ?>
<?php if ($_SESSION['role'] == 'Player') : ?>
				<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>You are not authorized to view this page</h2>
									</header>
								</article>
							</div>
						</header>
					</div>
				</section>
<?php endif; ?>