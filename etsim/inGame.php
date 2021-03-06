<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 15-12-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_game.php';
include_once 'includes/inGame.inc.php';
include_once 'includes/registerRoundGame.inc.php';

if(!isset($_SESSION))
    sec_session_start();
 
?>
<!DOCTYPE HTML>
<html>
	<?php include_once 'includes/layout/HeadBarInGame.php'; ?>
	<body>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Player') : ?>
			<!-- Admin -->
				<section class="wrapper style1" min-width="300px" width="30%" max-width="1000px">
					<div class="container">
						<header class="major">
							<div class="box post2">
								<article>
									<header>
										<h2>RESULTS TABLE</h2>
									</header>
										<?php
                                           
											if (isset($_POST['goInGame']) && $_POST['goInGame'] == 'goInGame') {
                                               //echo 'Je suis dans Go in game';
												$Uid = $_SESSION['user_id'];
												if ( (isset($_POST['id_etsim_game']) && !empty($_POST['id_etsim_game'])) && (isset($_POST['date_etsim_game']) && !empty($_POST['date_etsim_game'])) && (isset($_POST['description_etsim_game']) && !empty($_POST['description_etsim_game'])) ) {
													// Nettoyez et validez les données transmises au script
													//$idGame = $_POST['id_etsim_game'];
                                                    $_SESSION['id_etsim_game']=$_POST['id_etsim_game'];
                                                    $idGame = $_SESSION['id_etsim_game'];
													$date_etsim_game = $_POST['date_etsim_game'];
													$description_etsim_game = $_POST['description_etsim_game'];
												}
												if ($stmtSelectCurrentRoundNumber = $mysqli->prepare("	SELECT erg.number_etsim_round_game 
																										FROM etsim_round_game erg 
																										WHERE erg.id_etsim_round_game like '$idGame-$Uid-%'
																										GROUP BY erg.number_etsim_round_game
																										ORDER BY erg.number_etsim_round_game 
																										DESC LIMIT 1;")) {
													$stmtSelectCurrentRoundNumber->execute();    // Exécute la déclaration.
													//$stmtSelectCurrentRoundNumber->store_result();
													// Récupère les variables dans le résultat
													$stmtSelectCurrentRoundNumber->bindColumn('number_etsim_round_game',$roundGame);
													$stmtSelectCurrentRoundNumber->fetch();
													$roundGame = ($roundGame + 1);
                                                    $_SESSION['roundGame']=$roundGame;
												}
                                                 //Récupère le nb de joueur qui sont dans le jeu
                                                $totalU = countUserTotalInGame($mysqli, $idGame);
                                                // Récupère le nombre de joueurs qui ont terminé le round
                                                $totalUF = countUserTotalInGameFinnishRound($mysqli, $idGame, $roundGame);
                                                //Récupère le statut du jeu (Open, Play...)
                                                /*echo "<br/>Nb dans le jeu:".$totalU;
                                                echo "<br/>Nb fini:".$totalUF;*/
                                                /* if ( ((int)showtimeround($mysqli, $idGame, $roundGame)) <= 0)
                                                {
                                                   $roundGame=++$_SESSION['roundGame'];
                                                        
                                                }*/
                                                //Si tous les joueurs ont fini
                                                if ( $totalU == $totalUF ) {
                                                    //echo "<br/>Je finis le round";
                                                    //	echo '<script>alert()</script>';
                                                    if(!applyRoundGame($mysqli, $idGame, $roundGame))
                                                    {
                                                       // echo '<script type="text/javascript">window.location=window.location.href;</script>';
                                                        echo '<br/>Problème!!!!!!!';
                                                    }
                                                    else
                                                    {
                                                        $roundGame=++$_SESSION['roundGame'];
                                                    }
                                                        //die();
                                                }
                                                else if(((int)showtimeround($mysqli, $idGame, $roundGame)) <= 0)
                                                {
                                                    setFinishToRoundTemp($mysqli,$idGame,$_SESSION['user_id']);
                                                    if(!applyRoundGame($mysqli, $idGame, $roundGame))
                                                    {
                                                       // echo '<script type="text/javascript">window.location=window.location.href;</script>';
                                                        echo '<br/>Problème!!!!!!!';
                                                    }
                                                    else
                                                    {
                                                        $roundGame=++$_SESSION['roundGame'];
                                                    }
                                                    
                                                }
											}
											else if (isset($_SESSION['register_round']) && $_SESSION['register_round'] == 'register_round') {
                                                
                                                //echo 'Je suis dans Register Round';                                                
												if ( (isset($_POST['idetsimgame_etsim_round_game']) && !empty($_POST['idetsimgame_etsim_round_game'])) ) {
													$idGame = $_POST['idetsimgame_etsim_round_game'];
												}
                                                else
                                                {
                                                    //echo 'Je suis dans le else';
                                                    $idGame = $_SESSION['id_etsim_game'];
                                                    $roundGame=$_SESSION['roundGame'];
                                                    $Uid = $_SESSION['user_id'];
                                                }
                                                setFinishToRoundTemp($mysqli,$idGame,$_SESSION['user_id']);
                                                
                                                 //Récupère le nb de joueur qui sont dans le jeu
                                                $totalU = countUserTotalInGame($mysqli, $idGame);
                                                // Récupère le nombre de joueurs qui ont terminé le round
                                                $totalUF = countUserTotalInGameFinnishRound($mysqli, $idGame, $roundGame);
                                                //Récupère le statut du jeu (Open, Play...)
                                                /*echo "<br/>Nb dans le jeu:".$totalU;
                                                echo "<br/>Nb fini:".$totalUF;*/
                                                //Si tous les joueurs ont fini
                                                if ( $totalU == $totalUF) {
                                                    //echo "<br/>Je finis le round";
                                                    //	echo '<script>alert()</script>';
                                                    if(!applyRoundGame($mysqli, $idGame, $roundGame))
                                                    {
                                                       // echo '<script type="text/javascript">window.location=window.location.href;</script>';
                                                        echo '<br/>Problème!!!!!!!';
                                                    }
                                                    else
                                                    {
                                                        $roundGame=++$_SESSION['roundGame'];
                                                    }
                                                        //die();
                                                }
												
                                                //echo 'idGame:'.$idGame;
                                                unset($_SESSION['register_round']);
                                               // echo 'ça fonctionne';
											}
                                        else
                                        {
                                            //echo 'Je suis dans else';    
                                            $idGame = $_SESSION['id_etsim_game'];
                                            $Uid = $_SESSION['user_id'];
                                            $roundGame=$_SESSION['roundGame'];
                                            
                                            
                                                //Récupère le nb de joueur qui sont dans le jeu
                                                $totalU = countUserTotalInGame($mysqli, $idGame);
                                                // Récupère le nombre de joueurs qui ont terminé le round
                                                $totalUF = countUserTotalInGameFinnishRound($mysqli, $idGame, $roundGame);
                                                //Récupère le statut du jeu (Open, Play...)
                                                /*echo "<br/>Nb dans le jeu:".$totalU;
                                                echo "<br/>Nb fini:".$totalUF;*/
                                                //Si tous les joueurs ont fini
                                                if ( $totalU == $totalUF ) {
                                                    //echo "<br/>Je finis le round";
                                                    //	echo '<script>alert()</script>';
                                                    if(!applyRoundGame($mysqli, $idGame, $roundGame))
                                                    {
                                                       // echo '<script type="text/javascript">window.location=window.location.href;</script>';
                                                        echo '<br/>Problème!!!!!!!';
                                                    }
                                                    else
                                                    {
                                                        $roundGame=++$_SESSION['roundGame'];
                                                    }
                                                        //die();
                                                }  
                                                else if(((int)showtimeround($mysqli, $idGame, $roundGame)) <= 0)
                                                {
                                                    setFinishToRoundTemp($mysqli,$idGame,$_SESSION['user_id']);
                                                    if(!applyRoundGame($mysqli, $idGame, $roundGame))
                                                    {
                                                       // echo '<script type="text/javascript">window.location=window.location.href;</script>';
                                                        echo '<br/>Problème!!!!!!!';
                                                    }
                                                    else
                                                    {
                                                        $roundGame=++$_SESSION['roundGame'];
                                                    }
                                                    
                                                }
                                            
                                                
                                            
                                        }
                                    
                                        
                                            
                                        
										?>
                                    <a href="#openModal">Show other players status</a>
                                    <div id="openModal" class="modalDialog">
                                        <div>
                                            <a href="#close" title="Close" class="close">X</a>
                                            <h2>Status</h2>
                                            <?php 
                                            $liste=listMembersStatus($mysqli, $idGame, $roundGame);
                                            $i=1;
                                            foreach($liste as $donnee)
                                            {
                                                echo '<p>'.$i.'&nbsp;'.$donnee[0].'&nbsp'.$donnee[1].'</p>';
                                                $i++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    &nbsp;<a href="./stats.php">Show my results</a>
									<canvas id="myChart" width="400" height="200"></canvas>
									<table>
											<tr>
												<th>
													<b>ROUND NUMBER</b><br/>
												</th>
												<th>
													<b>BID VOLUME</b><br/>
												</th>
												<th>
													<b>DEMAND VOLUME</b><br/>
												</th>
												<th>
													<b>MARKET PRICE</b><br/>
												</th>
												<th>
													<b>INCOME</b><br/>
												</th>
												<th>
													<b>COST</b><br/>
												</th>
												<th>
													<b>BENEFIT</b><br/>
												</th>
												<th>
													<b>% of successful orders</b><br/>
												</th>
											</tr>
											<?php
                                                $currentStatusRoundGame = statusCurrentRoundGame($mysqli, $idGame, $roundGame);
												CurrentGameResults($mysqli, $idGame);
											?>
										</table>
									<header>
										<h2>PLANTS</h2>
									</header>
										<table>
											<tr>
												<th>
													<b>NUMBER</b><br/>
												</th>
												<th>
													<b>NAME</b><br/>
												</th>
												<th>
													<b>DESCRIPTION</b><br/>
												</th>
												<th>
													<b>NUMBER UNIT</b><br/>
												</th>
												<th>
													<b>POWER UNIT</b><br/>
												</th>
												<th>
													<b>FIXED COSTS</b><br/>
												</th>
												<th>
													<b>VARIABLE COSTS</b><br/>
												</th>
											</tr>
											<?php
                                                
												CurrentGamePlants($mysqli, $idGame);		
												$clock = showtimeround($mysqli, $idGame, $roundGame);
												$demandPower = showdemandPowerround($mysqli, $idGame, $roundGame);

											?>
										</table>
									<?php if ( ( ( ((int)showtimeround($mysqli, $idGame, $roundGame)) <= 0) || ( $currentStatusRoundGame == 1 )) && ( $roundGame >= 10) ) : ?>
										<h2>Game completed</h2>
										<?php die() ?>
									<?php  elseif ( ( ((int)showtimeround($mysqli, $idGame, $roundGame)) <= 0) || ( $currentStatusRoundGame == 1 )) : ?>
										<h2>Round completed</h2>
										<button onclick="window.location.reload()">next round</button>
									<?php	die();?>
									<?php endif ?>
									<div id="divInsertTable" class="container">
                                        
										<article>
											<header id="<?php echo $idGame; ?>" class="head_idGame">
                                                <h2 id="<?php echo $roundGame; ?>" class="round_number">INSERT TABLE ROUND N°<?php echo $roundGame; ?></h2>
                                                



                                                <p id="<?php echo $demandPower ;?>" class="demand_power">DEMAND POWER = <font color="red"><?php echo $demandPower;?></font> MW </p>
                                                <div class="box post2">
                                                    <div id="<?php echo $clock; ?>" class="clock" style="margin:2em;"></div>
                                                    <div class="message"></div>
                                                </div>
                                            </header>
                                            
                                            
                                            
                                            
										</article>
									</div>
                                    <?php 
											//InsertRowsRoundGame($mysqli, $idGame, $roundGame, $demandPower);          
                                    ?>
                                    <form method="post" action="includes/insert_row_round.php" >
                                        
                                        <table>
                                            <tr>
                                                <td>
                                                    Volume
                                                </td>
                                                <td>
                                                    Price
                                                </td>
                                                <td>
                                                    Power plant
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                     <input type="number" id="monVolume" name="volumeInGame" placeholder="200"  required="required"  value="1">
                                                </td>
                                                <td>
                                                    <input type="number" id="monPrice" name="priceInGame" placeholder="200"  required="required" autofocus="autofocus" value="1">
                                                </td>
                                                <td>
                                                    <?php getPowerPlantList($mysqli, $idGame, $roundGame); ?>
                                                </td>
                                                <td>
                                                    <input type="submit" value="Add Row"/>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <input type="hidden" name="demand" value="<?php echo $demandPower; ?>"/>
                                        <input type="hidden" name="numRound" value="<?php echo $roundGame; ?>"/>
                                    </form>
                                    
									<button href="javascript:void(0);" id='anc_rem'>Remove Row</button>
                                    
                                    <form method="post" action="includes/register_round.php" >
									<table id="tbl1" border="1" >
										<tr>
											<th>
												OFFER N°
											</th>
											<th>
												VOLUME
											</th>
											<th>
												PRICE
											</th>
											<th>
												POWER PLANT
											</th>
										</tr>
                                        
                                        
										
										<input type="hidden" name="register_line_round" class="line_etsim_round_game" value="<?php echo SelectLineRoundGameUser($mysqli, $idGame, $roundGame); ?>"/>
										<input type="hidden" name="delete_line_round" class="delete_line_etsim_round_game" value="<?php echo DeleteLineRoundGameUser($mysqli, $idGame, $roundGame); ?>"/>
										<input type="hidden" name="register_round" value="register_round"/>
										<input type="hidden" name="validate_etsim_round_game" value="true">
										<input type="hidden" name="idetsimgame_etsim_round_game" class="idetsimgame_etsim_round_game" id="<?php echo $idGame; ?>" value="<?php echo $idGame; ?>">
										<input type="hidden" name="idetsimmember_etsim_round_game" class="idetsimmember_etsim_round_game" id="<?php echo $Uid; ?>" value="<?php echo $Uid; ?>">
										<input type="hidden" name="number_etsim_round_game_temp" value="<?php GameRoundNumber($mysqli, $idGame); ?>">
										<?php
											$test = DeleteLineRoundGameUser($mysqli, $idGame, $roundGame);
                                            //Show the rows added by the user in the round
											SelectRowsTempRound($mysqli, $idGame, $roundGame, $test);
										?>
									</table>
                                        <input type="submit" value="Register"/>
                                  
                                    </form>
										
									<?php  ?>
								</article>
							</div>
						</header>
					</div>
				</section>
			<!-- Admin -->
					
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
	<script>initVolumeLookup();</script>
	</body>
</html>