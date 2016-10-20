<?php
/*
* Created by : bryan.maisano@gmail.com
* date * 05-12-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_game.php';
if(!isset($_SESSION))
    sec_session_start();
?>
<!DOCTYPE HTML>
<html>
	<?php 
	   include_once 'includes/layout/HeadBarPlayGame.php'; 
    ?>
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
			<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Player' ) : ?>			
			<!-- Main -->
				<section class="wrapper style1" min-width="300px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>GAME OPEN</h2>
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
													<b>DATE CREATE GAME</b><br/>
												</th>
												<th>
													<b>DESCRIPTION GAME</b><br/>
												</th>
												<th>
													<b>GIVE PASSWORD GAME</b><br/>
												</th>
											</tr>
											<?php
												createTableGameOpen($mysqli);
											?>
										</table>
									</div>
									<header>
										<h2>CURRENT GAME</h2>
									</header>
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
											</tr>
											<?php
												createTableGameInGame($mysqli);
											?>
										</table>
									</div>
									<header>
										<h2>COMPLETED GAME</h2>
									</header>
									<div class="box post3">
										<table>
											<tr>
												<th>
													<b>DATE CREATE GAME</b><br/>
												</th>
												<th>
													<b>DESCRIPTION GAME</b><br/>
												</th>
											</tr>
											<?php
												createTableGameCompletedGame($mysqli);
											?>
										</table>
									</div>
								</article>
							</div>
						</header>
					</div>
				</section>
			<?php else : ?>
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
			<!-- CTA -->
				<section id="cta" class="wrapper style3">
				</section>

			<!-- Copyright -->
				<?php include_once 'includes/layout/CopyrightBar.php'; ?>
		</div>
	</body>
</html>