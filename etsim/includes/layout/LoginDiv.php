<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 02-01-2016
*/ ?>
<section class="wrapper style1" min-width="800px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<h1>LOGIN TO SERIOUS GAME</h1>
								<?php
									if (!empty($error_msg)) {
										echo $error_msg;
									}
									if (isset($_GET['error'])) {
										echo '<p class="error">Bad User/Password!</p>';
										echo '<p class="error">User not activated!</p>';
									}
								?>
								<?php if (login_check($mysqli) == false) : ?>
									<form method="post" action="includes/process_login.php">
									<input type="hidden" name="formlogin" value="formlogin"/>
										<div id="divlogin">
											<input 	type="text" 
													name="login" 
													placeholder="Username or Email">
											<input 	type="password" 
													name="password" 
													placeholder="Password">
										</div>
										<div id="divlogin">
											<label>
												<input 	type="checkbox" 
														name="remember_me" 
														id="remember_me">Remember me on this computer<br>
											</label>
										</div>
										<div id="divlogin">
											<input type="submit" name="commit" value="Login">
										</div>
									</form>
									<div id="divlogin">
										<p id="plogin">Register me <a href="register.php">Click here to register</a>
										<p id="plogin">Forgot your password? <a href="lost_pwd.php">Click here!</a>.</p>
									</div>
								<?php else : ?>
									<div>
										<p>Welcome <?php echo htmlentities($_SESSION['username'])." you are ".htmlentities($_SESSION['role']) ; ?>!</p>
										<p>Institution: <?php echo htmlentities($_SESSION['institution']) ; ?></p>
										<p><a href="includes/logout.php">LOGOUT | </a><a href="change_pwd.php">CHANGE PWD</a></p>
									</div>
								<?php endif; ?>
							</div>
						</header>
					</div>
				</section>