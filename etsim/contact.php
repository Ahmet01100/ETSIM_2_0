<?php
/*
* Created by : bryan.maisano@gmail.com
* date * 05-10-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/send_form_email.php';
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
										<h2>CONTACT FORM</h2>
										<p>If you have any questions, please fill-in the following form :</p>
									</header>
									<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
										<input type="hidden" name="contactform" value="contactform"/>
										<div class="row 50%">
											<div class="6u 12u(mobilep)">
												<input type="text" name="name" id="name" placeholder="Name" />
											</div>
											<div class="6u 12u(mobilep)">
												<input type="email" name="email" id="email" placeholder="Email" />
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<textarea name="message" id="message" placeholder="Message" rows="5"></textarea>
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" class="button alt" value="Send Message" /></li>
												</ul>
											</div>
										</div>
									</form>
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