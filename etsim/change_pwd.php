<?php
/*
* Created by : bryan.maisano@gmail.com
* date * 08-11-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/modifypwd.php';
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
			<?php
				if (!empty($success)) {
					echo $success;
				}
			?>
			<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Player') : ?>			
			<!-- Main -->
				<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>Change your password</h2>
									</header>
									<?php
													if (!empty($error_msg)) {
														echo $error_msg;
													}
									?>
									<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
										<input type="hidden" name="changepwdform" value="changepwdform"/>
										<div class="row 50%">
											<div class="6u 12u(mobilep)">
												<input type="password" name="pwd" id="pwd" placeholder="Password" />
											</div>
											<div class="6u 12u(mobilep)">
												<input type="password" name="cpwd" id="cpwd" placeholder="Confirm password" />
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" class="button alt" value="Change" /></li>
												</ul>
											</div>
										</div>
									</form>
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