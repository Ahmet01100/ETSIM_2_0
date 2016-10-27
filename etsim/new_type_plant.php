<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 12-10-2015
*/
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
	include_once 'includes/registertypeplant.inc.php';
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
										<h2>ADD NEW TYPE PLANT</h2>
                                        
									</header>
										<fieldset><legend>Details</legend>
											<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
												<input type="hidden" name="registertypeplant" value="registertypeplant"/>
													<table>
														<tr>
															<td>
																<label for="etsim_type_plant" class="formlabel">NAME TYPE</label>
															</td>
															<td>
																<input id="name_etsim_type_plant" name="name_etsim_type_plant" type="text" class="name_etsim_type_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_type_plant" class="formlabel">DESCRIPTION</label>
															</td>
															<td>
																<input id="description_etsim_type_plant" name="description_etsim_type_plant" type="text" class="description_etsim_type_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_type_plant" class="formlabel">MIN VARIABLE COSTS</label>
															</td>
															<td>
																<input id="minv_costs_etsim_type_plant" name="minv_costs_etsim_type_plant" type="number" step="0.0000000000001" class="minv_costs_etsim_type_plant">
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_type_plant" class="formlabel">MAX VARIABLE COSTS</label>
															</td>
															<td>
																<input id="maxv_costs_etsim_type_plant" name="maxv_costs_etsim_type_plant" type="number" step="0.0000000000001" class="maxv_costs_etsim_type_plant">
															</td>
														</tr>
														<tr>
															<td>
																<input type="submit" name="commitNewPlant" value="ADD">
																<div id="divlogin"></div>
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