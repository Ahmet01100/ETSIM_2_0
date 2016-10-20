<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 /*
* Created by : bryan.maisano@gmail.com
* date * 05-10-2015
*/
?>
<!DOCTYPE HTML>
<html>
	
	<?php 
	/*
	* Add by : bryan.maisano@gmail.com
	* date * 09-11-2015
	*/
	include_once 'includes/layout/HeadBar.php'; ?>
	<body>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php 
			/*
			* Add all include_once by : bryan.maisano@gmail.com
			* date * 09-11-2015
			*/
			include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			<!-- Main -->
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>CREATORS</h2>
									</header>
									<article>
										<p id="pcreators">ETSIM is developed by two former students of the <a href="http://www.utbm.fr">University of Technology of Belfort-Montbéliard</a> (UTBM, France) : Baptiste MOUTERDE and Bryan MAISANO under the supervision of Associate Professor <a href="http://robinroche.com/">Dr. Robin Roche</a>.</p>
										<div class="title">
											<span class="byline" id="Crespo">Baptiste MOUTERDE</span> 
										</div>
										<p>baptiste.mouterde@utbm.fr</p>
										<div class="title">
											<span class="byline" id="Frost">Bryan MAISANO</span> 
										</div>
										<p>bryan.maisano@gmail.com</p> 
									<br></br>	
									</article>
								</article>
							</div>
						</header>
					</div>
				</section>

		<!-- CTA -->
				<section id="cta" class="wrapper style3">
				</section>

		<!-- Copyright -->
			<?php include_once 'includes/layout/CopyrightBar.php'; ?>
		</div>
	</body>
</html>