<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 12-10-2015
*/
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
	include_once 'includes/registergame.inc.php';
	sec_session_start();
	
	if (!empty($error_msg)) {
		echo $error_msg;
	}
?>

<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>ADD NEW GAME</h2>
									</header>
										<fieldset><legend>Details</legend>
											<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
												<input type="hidden" name="registergame" value="registergame"/>
												<table>
														<tr>
															<td>
																<label for="etsim_game" class="formlabel">Descritpion</label>
															</td>
															<td>
																<input id="name_etsim_game" name="name_etsim_game" type="text" class="forminput" />
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_game" class="formlabel">Password</label>
															</td>
															<td>
																<input id="password_etsim_game" name="password_etsim_game" type="password" />
															</td>
														</tr>
														<tr>
															<td>
																<label for="etsim_game" class="formlabel">Max player</label>
															</td>
															<td>
																<input id="maxplayer_etsim_game" name="maxplayer_etsim_game" type="text" class="forminput" />
															</td>
														</tr>	
												</table>
												<input type="submit" name="commitNewGame" value="ADD">
											</form>
										</fieldset>
								</article>
							</div>
						</header>
					</div>
</section>
<?php endif; ?>
<?php if ($_SESSION['role'] == 'Player') : ?>
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
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