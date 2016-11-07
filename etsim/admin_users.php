<?php
/*
* created by : bryan.maisano@gmail.com
* date * 10-11-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

if(!isset($_SESSION))
    sec_session_start();
 
?>
<!DOCTYPE HTML>
<html>
	<?php 
	/*
	* Add all include_once by : bryan.maisano@gmail.com
	* date * 09-11-2015
	*/
	include_once 'includes/layout/HeadBarAdminUsers.php'; ?>
	<body>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			
			<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
			<!-- Admin -->
				<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>Administrator</h2>
									</header>
									<table>
										<tr><th><b style="color:white">Identifiant</b></th>
											<th><b style="color:white" >Username</b></th>
											<th><b style="color:white">Email</b></th>
											<th><b style="color:white">Institution</b></th>
											<th><b style="color:white">Role</b></th>
											<th><b style="color:white">Enable</b></th></tr>
										<?php 
											$sql_query_admin = 'SELECT 	id_etsim_members
																		,username_etsim_members
																		,email_etsim_members
																		,role_etsim_members
																		,enable_etsim_members
																		,group_etsim_members
																FROM etsim_members
																WHERE role_etsim_members = "Admin";';
											createTable($mysqli, $sql_query_admin);
										?>
									</table>
								</article>
							</div>
						</header>
					</div>
				</section>
			<!-- Admin -->
			<div>
				<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>Manager</h2>
									</header>
									<table>
										<tr><th><b style="color:white">Identifiant</b></th>
											<th><b style="color:white" >Username</b></th>
											<th><b style="color:white">Email</b></th>
											<th><b style="color:white">Institution</b></th>
											<th><b style="color:white">Role</b></th>
											<th><b style="color:white">Enable</b></th>
										</tr>
										<?php 
											$sql_query_manager = 'SELECT 	id_etsim_members
																		,username_etsim_members
																		,email_etsim_members
																		,role_etsim_members
																		,enable_etsim_members
																		,group_etsim_members
																  FROM etsim_members
																  WHERE role_etsim_members = "Manager";';
											createTable($mysqli, $sql_query_manager);
										?>
									</table>
								</article>
							</div>
						</header>
					</div>
				</section>
			</div>
			
			<!-- Admin -->
			<div>
				<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>Player</h2>
									</header>
									<table>
										<tr><th><b style="color:white">Identifiant</b></th>
											<th><b style="color:white" >Username</b></th>
											<th><b style="color:white">Email</b></th>
											<th><b style="color:white">Institution</b></th>
											<th><b style="color:white">Role</b></th>
											<th><b style="color:white">Enable</b></th>
										</tr>
										<?php 
										/*
										* Add by : bryan.maisano@gmail.com
										* date * 12-11-2015
										*/
											$sql_query_player = 'SELECT 	id_etsim_members
																			,username_etsim_members
																			,email_etsim_members
																			,role_etsim_members
																			,enable_etsim_members
																			,group_etsim_members
																FROM etsim_members
																WHERE role_etsim_members = "Player";';
											createTable($mysqli, $sql_query_player);
											//$mysqli->close();
										?>
									</table>
								</article>
							</div>
						</header>
					</div>
				</section>
			</div>
			
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