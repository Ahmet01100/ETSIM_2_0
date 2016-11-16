<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 12-10-2015
*/
include_once 'includes/functions.php';
include_once 'includes/register.inc.php';
 
sec_session_start();
 
?>
<!DOCTYPE HTML>
<html>
	<?php include_once 'includes/layout/HeadBar.php'; ?>
	<body>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
				<!-- Main -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<div class="8u 12u(narrower)">
								<div id="content">
									<!-- Content -->
										<article>
											<header>
												<h2>REGISTER FORM</h2>
												<?php
													if (!empty($error_msg)) {
														echo $error_msg;
													}
													if (!empty($success_msg)) {
														echo $success_msg;
													}
												?>
											</header>
											<ul>
												<li>Usernames may contain only digits, upper and lower case letters and underscores</li>
												<li>Emails must have a valid email format</li>
												<li>Passwords must be at least 6 characters long</li>
												<li>Passwords must contain
													<ul>
														<li>At least one upper case letter (A..Z)</li>
														<li>At least one lower case letter (a..z)</li>
														<li>At least one number (0..9)</li>
													</ul>
												</li>
												<li>Your password and confirmation must match exactly</li>
											</ul>
											<form   action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
													method="post">
												<input type="hidden" name="registration_form" value="registration_form"/>
												Username: <input type='text' 
													name='username' 
													id='username'
													x-moz-errormessage="Your name is required!"
													required="required"
													autofocus="autofocus"
													value="<?php 
														if (isset($_POST['username'])) 
															echo htmlentities(trim($_POST['username'])); 
														?>"/><br>
												Email: <input 	type="text" 
																name="email" 
																id="email" 
																placeholder="exemple@domaine.com"
																x-moz-errormessage="Email is required!"
																required="required"
																autofocus="autofocus"
																value="<?php 
																if (isset($_POST['email'])) 
																	echo htmlentities(trim($_POST['email'])); 
																?>"/><br>
												Institution: 
                                                
                                                <select id="institution" class="form-control" name="institution">
                                                <?php
                                                $liste=listInstitution($mysqli);
                                                foreach ($liste as $institution) 
                                                {
                                                    echo '<option ';
                                                    if(isset($_POST['institution']) && $_POST['institution']==$institution[1])
                                                    {
                                                        echo 'selected="selected" ';
                                                    }                                                    
                                                    echo ' id="'.$institution[0].'" value="'.$institution[1].'" class="institutionClass">"'.$institution[1].'"</option>';
                                                }
                                                
                                                ?>
                                                </select><br/>
                                                
                                                <!--
                                                <input 	type="text" 
																name="institution" 
																id="institution" 
																placeholder="UTBM"
																x-moz-errormessage="Institution is required!"
																required="required"
																autofocus="autofocus"
																value="<?php /*
																if (isset($_POST['institution'])) 
																	echo htmlentities(trim($_POST['institution'])); */
																?>"/> -->
                                                
                                                
                                                <br>  
												Password: 
                                            
                                                <input 	type="password"
																	name="password" 
																	id="password"
																	x-moz-errormessage="Password is required!"
																	required="required"
																	autofocus="autofocus"
																	value="<?php 
																	if (isset($_POST['password'])) 
																		echo htmlentities(trim($_POST['password'])); 
																	?>"/><br>
												Confirm password: <input 	type="password" 
																			name="confirmpwd" 
																			id="confirmpwd"
																			x-moz-errormessage="Same password is required!"
																			required="required"
																			autofocus="autofocus"
																			value="<?php 
																			if (isset($_POST['confirmpwd'])) 
																				echo htmlentities(trim($_POST['confirmpwd'])); 
																			?>"/><br>
                                               
												<input type="submit" name="register" id="register" value="Register" /> 
											</form>
											<p>Return to the <a href="index.php">login page</a>.</p>
										</article>
								</div>
							</div>
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