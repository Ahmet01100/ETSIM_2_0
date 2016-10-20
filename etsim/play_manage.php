<?php
/*
* Created by : bryan.maisano@gmail.com
* date * 02-12-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_game.php';

if(!isset($_SESSION))
    sec_session_start();
 
 
?>
<!DOCTYPE HTML>
<html>
	<?php include_once 'includes/layout/HeadBarPlayManage.php'; ?>
	<body>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			<?php
				if (!empty($success)) {
					echo $success;
				}
			?>
			<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' ) : ?>			
			<!-- Main -->
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>GAME MANAGE</h2>
									</header>
									<?php
													if (!empty($error_msg)) {
														echo $error_msg;
													}
													if (!empty($success_msg)) {
														echo $success_msg;
													}
									?>
									<div class="box post3">
										<table>
											<tr>
												<th>
													<b>ID GAME</b><br/>
												</th>
												<th>
													<b>DATE CREATE GAME</b><br/>
												</th>
												<th>
													<b>DESCRIPTION GAME</b><br/>
												</th>
												<th>
													<b>PLAYER IN GAME</b><br/>
												</th>
												<th>
													<b>PLAYER OUT GAME</b><br/>
												</th>
												<th>
													<b>ENABLE GAME</b><br/>
												</th>
												<th>
													<b>SHOW GAME</b><br/>
												</th>
												<th>
													<b>DELETE GAME</b><br/>
												</th>
											</tr>
											<?php
												createTableGame($mysqli);
											?>
										</table>
									</div>
									<div class="box post2">
										<table>
											<tr>
												<td>
													<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
														<input type="hidden" name="newgame" value="newgame"/>
														<div class="row 50%">
															<div class="6u 12u(mobilep)">
																<ul class="actions">
																	<li><input id="new_game" type="submit" class="button alt" value="New game" /></li>
																</ul>
															</div>
														</div>
													</form>
												</td>
												<td>
													<input type="button" id="btnRight" value ="  >>  " class="'.$rowresultstmttableSelectGame['id_etsim_game'].'"/>
												</td>
												<td>
													<input type="button" id="btnLeft" value ="  <<  " class="'.$rowresultstmttableSelectGame['id_etsim_game'].'" />
												</td>
											</tr>
										</table>
									</div>
								</article>
							</div>
						</header>
					</div>
				</section>
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>PLANT MANAGE</h2>
									</header>
									<?php
													if (!empty($error_msg)) {
														echo $error_msg;
													}
													if (!empty($success_msg)) {
														echo $success_msg;
													}
									?>
									<div class="box post3">
										<table>
											<tr>
												<th>
													<b>ID</b><br/>
												</th>
												<th>
													<b>NAME</b><br/>
												</th>
												<th>
													<b>POWER UNIT</b><br/>
												</th>
												<th>
													<b>COST MW</b><br/>
												</th>
												<th>
													<b>OM MW</b><br/>
												</th>
												<th>
													<b>RDT</b><br/>
												</th>
												<th>
													<b>CONSTRUCTION</b><br/>
												</th>
												<th>
													<b>OPERATION</b><br/>
												</th>
											</tr>
											<?php
												createTablePlant($mysqli);
											?>
										</table>
									</div>
									<div class="box post2">
										<table>
											<tr>
												<td>
													<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
														<input type="hidden" name="newplant" value="newplant"/>
														<div class="row 50%">
															<div class="6u 12u(mobilep)">
																<ul class="actions">
																	<li><input id="new_plant" type="submit" class="button alt" value="New plant" /></li>
																</ul>
															</div>
														</div>
													</form>
												</td>
											</tr>
										</table>
									</div>
								</article>
							</div>
						</header>
					</div>
				</section>
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>TYPE PLANT MANAGE</h2>
									</header>
									<?php
													if (!empty($error_msg)) {
														echo $error_msg;
													}
													if (!empty($success_msg)) {
														echo $success_msg;
													}
									?>
									<div class="box post3">
										<table>
											<tr>
												<th>
													<b>ID</b><br/>
												</th>
												<th>
													<b>NAME</b><br/>
												</th>
												<th>
													<b>DESCRIPTION</b><br/>
												</th>
												<th>
													<b>MIN VARIABLE COSTS</b><br/>
												</th>
												<th>
													<b>MAX VARIABLE COSTS</b><br/>
												</th>
											</tr>
											<?php
												createTableTypePlant($mysqli);
											?>
										</table>
									</div>
									<div class="box post4">
										<table>
											<tr>
												<td>
													<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
														<input type="hidden" name="newtypeplant" value="newtypeplant"/>
														<div class="row 50%">
															<div class="6u 12u(mobilep)">
																<ul class="actions">
																	<li><input id="new_type_plant" type="submit" class="button alt" value="New type" /></li>
																</ul>
															</div>
														</div>
													</form>
												</td>
											</tr>
										</table>
									</div>
								</article>
							</div>
						</header>
					</div>
				</section>
			<?php else : ?>
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
			<!-- CTA -->
				<section id="cta" class="wrapper style3">
				</section>

			<!-- Copyright -->
				<?php include_once 'includes/layout/CopyrightBar.php'; ?>
		</div>
	</body>
</html>