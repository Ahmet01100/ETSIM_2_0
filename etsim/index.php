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
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; 
            
            /*echo 'user_id:'.$_SESSION['user_id'].'<br/>';
            echo 'role:'.$_SESSION['role'];*/
            ?>
            
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			<!-- MAIN -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row">
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic01.jpg" alt="" /></a>
									<div class="inner">
										<h3>What is Serious Game ?</h3>
										<p>Serious game is a game that mainly focuses on two aspects of the electricity market : the Spot market and long term investments.</p>
									</div>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic02.jpg" alt="" /></a>
									<div class="inner">
										<h3>SPOT MARKET</h3>
										<p>The Spot market simulator is here to provide a better understanding of the electricity Spot market. Each player will be assigned a panel of power plants of different type and will have to make bids to fit the electrical demand.</p>
									</div>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic03.jpg" alt="" /></a>
									<div class="inner">
										<h3>COMPLETE GAME</h3>
										<p>The Complete game focuses on long term investment and on combustible prices. In this game, players have to build new power plants in order to meet demand. Each round corresponds to a whole year.</p>
									</div>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic04.jpg" alt="" /></a>
									<div class="inner">
										<h3>CHANGELOG</h3>
										<p>17/09/2014 : SERIOUS GAME v1.0 has been released. Further information can be found in the PLAY/RULES section.</p>
									</div>
								</div>
							</section>
						</div>
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