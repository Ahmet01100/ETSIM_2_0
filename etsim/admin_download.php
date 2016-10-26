<?php
/*
* Created by : bryan.maisano@gmail.com
* date * 05-10-2015
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
	include_once 'includes/layout/HeadBar.php'; ?>
	<body>
		<?php if ($_SESSION['role'] == 'Admin') : ?>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			<!-- Main -->
				<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>FIlES ETSIM :</h2>
										<p>Zip Install for ETSIM Serious Game!</p>
									</header>
									<a href="db/etsim.zip">Image</a>
								</article>
							</div>
						</header>
					</div>
				</section>
			<!-- CTA -->
				<section id="cta" class="wrapper style3">
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
			<!-- Copyright -->
				<?php include_once 'includes/layout/CopyrightBar.php'; ?>
		</div>
	</body>
</html>