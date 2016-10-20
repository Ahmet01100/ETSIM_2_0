<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 11-10-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/lostpwd.php';

sec_session_start();
echo $_SESSION['user_id'];
if (!empty($_SESSION['user_id'])) {
	$session = 1;
} else {
	$session = 0;
}
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
			<!-- Main -->
			<?php if ( $session == 0 ) : ?>	
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>Reset your password</h2>
									</header>
									<?php
													if (!empty($error_msg)) {
														echo $error_msg;
													}
													if (!empty($success)) {
														echo $success;
													}
									?>
									<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
										<input type="hidden" name="lostpwdform" value="lostpwdform"/>
										<div class="row 50%">
											<div class="6u 12u(mobilep)">
												<input type="email" name="email" id="email" placeholder="Email" />
											</div>
											<div class="row 50%">
												<div class="12u">
													<ul class="actions">
														<li><input type="submit" class="button alt" value="Send" /></li>
													</ul>
												</div>
											</div>
										</div>
									</form>
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
										<h2>You are logged! It's only for member who have forgotten her password</h2>
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