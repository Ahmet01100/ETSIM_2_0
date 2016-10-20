<!DOCTYPE HTML>
<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 02-01-2016
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_game.php';

sec_session_start();
 
?>
<html>
	<?php include_once 'includes/layout/HeadBarRules.php'; ?>
	<body>
		<div id="page-wrapper">
			<!-- Navigation Bar -->
			<?php include_once 'includes/layout/NavigBar.php'; ?>
			<!-- Login Bar -->
			<?php include_once 'includes/layout/LoginDiv.php'; ?>
			<!-- Main -->
			<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Player') : ?>
				<div class="wb-tabs ignore-session">
					<div class="container">
						<ul class="tabs">
							<li><a href="#tab1"><b>CLICK HERE</b> FOR SEE : PLAYER INFORMATIONS</a></li>
							<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
							<li><a href="#tab2"><b>CLICK HERE</b> FOR SEE : MANAGER INFORMATIONS</a></li>
							<?php endif; ?>
						</ul>
						<div class="tab_container" style="background-color:lightgrey;" >
							<div id="tab1" class="tab_content">
								<div class="row 200%">
									<div class="4u 12u(narrower)">
										<div id="sidebar">
											<section>
												<h3>Content:</h3>
												<ul>
													<li><a href="#lien1"><font color="#007EB4"><b>1 ETSIM presentation</b></font></a></li>
													<ul>
														<li><a href="#lien11"><font color="#000000">1.1 Market game</font></a></li>
														<li><a href="#lien12"><font color="#000000">1.2 Complete game</font></a></li>
														<li><a href="#lien13"><font color="#000000">1.3 User profiles</font></a></li>
													</ul>
													<li><a href="#lien2"><font color="#007EB4"><b>2 Creating an account and login</b></font></a></li>
													<li><a href="#lien3"><font color="#007EB4"><b>3 Main page description</b></font></a></li>
													<ul>
														<li><a href="#lien31"><font color="#000000">3.1 Open games</font></a></li>
														<li><a href="#lien32"><font color="#000000">3.2 Join a game</font></a></li>
														<li><a href="#lien33"><font color="#000000">3.3 Your past games</font></a></li>
													</ul>
													<li><a href="#lien4"><font color="#007EB4"><b>4 The Market game</b></font></a></li>
														<ul>
															<li><a href="#lien41"><font color="#000000">4.1 Presentation of the game and aim</font></a></li>
															<li><a href="#lien42"><font color="#000000">4.2 How to play</font></a></li>
															<ul>
																<li><a href="#lien421"><font color="#808080"><i>4.2.1 Power plants</i></font></a></li>
																<li><a href="#lien422"><font color="#808080"><i>4.2.2 Bids</i></font></a></li>
															</ul>
															<li><a href="#lien43"><font color="#000000">4.3 Past rounds</font></a></li>
														</ul>
													<li><a href="#lien5"><a href="#lien5"><font color="#007EB4"><b>5 Game analysis</b></font></a></li>
												</ul>
											</section>						
											<section>
												<h3>For further questions, please send us an email at:</h3>
												<ul class="links">
													<li><strong>robin.roche@utbm.fr</strong></li>
												</ul>
											</section>
										</div>
									</div>
									<div class="8u  12u(narrower) important(narrower)">
										<div id="content">
											<!-- Content -->
											<article>
												<header>
													<h2>The ETSIM Player Guide describes the following aspects:</h2>
													<ul class="links">
														<li>Creating an account</li>
														<li>What are the two games available with ETSIM</li>
														<li>How to play</li>
														<li> How to view results from past games</li>
													</ul>
												</header>
												<h2 id="lien1">1 ETSIM presentation</h2>
												<p>ETSIM provides two different games that allow players to get a better understanding on different aspects of the Energy Market.</p>
												<h3 id="lien11">1.1 Market game</h3>
												<p>The Market game focuses on the SPOT Market where each player has to manage a panel of five different power plants with unique characteristics in terms of:
												<li>Type</li>
												<li>Capacity</li>
												<li>Variable costs</li>
												<li>Fixed costs</li>
												This game simulates a day in a country where demand (in terms of MW) changes at each round.
												Each round corresponds to an hour.
												Players have to make different bids (volume and price) in order to respond to the demand of the
												market. The aim for the player is to meet market’s demand in order to make profit.</p>
												<h3 id="lien12">1.2 Complete game</h3>
												<p>The Complete game focuses on long term investment and on combustible prices. In this game, players have to build new power plants in order to meet demand. Each round corresponds to a whole year.</p>
												<h3 id="lien13">1.3 User profiles</h3>
												<p>Three roles (or profiles) exist in ETSIM:
												<li>Administrator: administrates ETSIM</li>
												<li>Game Manager: creates game</li>
												<li>Player: plays the different games</li>
												At registration, default profile is set to Player.</p>
												<h2 id="lien2">2 Creating an account and login</h2>
												<p>In order to play to ETSIM, you first need to create an account
												<li>Go to the ETSIM platform you are going to play on</li>
												<li>Click on play</li>
												<li>Click on register</li>
												<li>Follow the instructions to create your account</li>
												<li>Login</li>
												You are now successfully logged in!</p>
												<h2 id="lien3">3 Main page description</h2>
												<p>Once logged in, the Player is redirected to the ETSIM main page.</p>
												<h3 id="lien31">3.1 Open games</h3>
												<p>This section shows the Player the list of the open games that can be joined.
												It provides the follwong information:
												<li>Date</li>
												<li>Type: Market or Complete game</li>
												<li>Name</li>
												<li>Comments from the Game Mananger</li>
												<li>Status: Open for players / Play / Close (impossible to see) / Completed</li></p>
												<span class="image featured"><img src="images/GameStatus.JPG" alt="" /></span>
												<p>Figure 3.1: Satuts Games lis</p>
												<h3 id="lien32">3.2 Join a game</h3>
												<p>To join a particular game, choose the game, entre the password and click on Join Game.</p>
												<span class="image featured"><img src="images/JoinGame.JPG" alt="" /></span>
												<p>Figure 3.2: How to join a game</p>
												<h3 id="lien33">3.3 Your past games</h3>
												<p>This table shows the Player the list of all the games he played and allows him to access to the Game Analysis page to view his results.</p>
												<span class="image featured"><img src="images/CompletedGame.JPG" alt="" /></span>
												<p>Figure 3.3: Past games list</p>
												<h2 id="lien4">4 The Market game</h2>
												<h3 id="lien41">4.1 Presentation of the game and aim</h3>
												<p style="text-align:justify;" >The market game, or SPOT game, simulates the SPOT market on the energy market. Several players who each own five power plants try to sell their production in order to make profits by meeting
												the market’s demand.A round corresponds to the demand at one time of the day and thus increases or decreases during the game and the players must adapt their strategy.</p>
												<p style="text-align:justify;" >Power plants have different characterisitcs that the players must take into account. The two most important are the Variable costs and the Fixed costs.Fixed costs will be charged to the player at the end of each round even if he chose not to produce
												with his plant. Fixed costs are expenses that are not dependent on the level of production.Variable costs, expressed in €/MWh are only charged to the player if he succeeded to sell his production. It mostly corresponds to the cost of the combustible.
												The SPOT game uses a market analysis algorithm that gathers all bids and sort them in increasing order of price. Once the aggregate bids meet the volume market’s demand, the SPOT price is determined as the last (which means the highest) price that met the market’s demand.
												This means that every bids that were accepted will be payed at the SPOT price. Bids that were rejected will not get anything.</p>
												<p style="text-align:justify;" >The following graph shows how the algorithm works. In red is displayed the bids made by the Players sorted in increasing order.In blue is displayed the Demand. Offers that are accepted are located on the left side of the blue curve.
												Offers that are rejected are placed on the right side of the blue curve.</p>
												<p style="text-align:justify;" >You can also note that the last accepted offer is the same line than the demand value. It means that this offer will not be accpeted in totality.</p>
												<span class="image featured"><img src="images/displayedResults.JPG" alt="" /></span>
												<p>Figure 4.1: Displayed results</p>
												<h3 id="lien42">4.2 How to play</h3>
												<p>As explained, the aim for the player is to meet the market’s demand by selling its production in order to make profits. To do so, he has to place bids that will be function of the power plants the Players owns and of the demand.</p>
												<h1 id="lien421">4.2.1 Power plants</h1>
												<p>The table below shows the list of power plants owned by the Player. It shows:
												<li>The name of the plant</li>
												<li>Power: Production capacity of the plant in MW</li>
												<li>Type of plant</li>
												<li>Variable costs in €/MWh</li>
												<li>Fixed cost in euros that will be charged to the player even if he does not place a bid for this plant</li></p>
												<span class="image featured"><img src="images/PLantGameMember.JPG" alt="" /></span>
												<p>Figure 4.2: Power plants portfolio of a player</li></p>
												<p>Please also note that the round number is also displayed at the top of this section.</p>
												<h1 id="lien422">4.2.2 Bids</h1>
												<p style="text-align:justify;" >As explained, the Player has to place bids, in terms of Volume and Price, to meet the market’s demand. The demand, expressed in MW is displayed for each round and corresponds to a certain percentage of the installed capacity.
												<p style="text-align:justify;" >To make a bid, the Player has to select the corresponding plant and make an offer in terms of volume and price.</p>
												<p style="text-align:justify;" >It is possible to make different offers for a same plant. In that case, fixed costs are only charged once.</p>
												<p style="text-align:justify;" >Bids can not exceed 180€/MW.</p>
												<p style="text-align:justify;" >To add a new offer, click on new one.</p>
												<p style="text-align:justify;" >To delete the last offer, click on remove last one.</p>
												<p style="text-align:justify;" >Once done, click on Send.</p>
												The page will automatically refresh once all the players will have place their bids.</p>
												<span class="image featured"><img src="images/AddLineRound.JPG" alt="" /></span>
												<p>Figure 4.3: Bids</p>
												<h3 id="lien43">4.3 Past rounds</h3>
												<p style="text-align:justify;">This section displays the results from the previous rounds. The first table shows the SPOT price and the Demand value The second table shows the list of the bids made by the player and if they were accepted (totally or not). Finally, the third table gives to the player:
												<li>Income for this round</li>
												<li>Costs for this round</li>
												<li>Benefits for this round</li>
												<li>Capital owned by the player</li></p>
												<span class="image featured"><img src="images/PastRoundGame.JPG" alt="" /></span>
												<p>Figure 4.4: Last round results</p>
												<p>Furthermore, two graphs are displayed to show the bids placed by all players and to show the demand. The second graph shows the evolution of the capital for the player.</p>
												<h2 id="lien5">5 Game analysis</h2>
												<p style="text-align:justify;">The Game Analysis is a feature that is available when the game is over. Players can access to is from the main page.
												It provides the results from every round of a given game.
												The Game Analysis provides the same information that were described in the previous section.
												In the Past Rounds section if the All rounds option is selected, it will display at the same time the
												results for every round. It is also possible to choose round individually.</p>
											</article>
										</div>
									</div>
								</div>
							</div>
							<div id="tab2" class="tab_content">
								<?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
								<div class="container">
									<div class="row 200%">
										<div class="4u 12u(narrower)">
											<div id="sidebar">
													<section>
														<h3>Content:</h3>
														<ul>
															<li><a href="#mlien1"><font color="#007EB4"><b>1 Manager panel</b></font></a></li>
															<ul>
																<li><a href="#mlien11"><font color="#000000">1.1 Manage Game</font></a></li>
																	<ul>
																		<li><a href="#mlien111"><font color="#000000">1.1.1 Add Ggame</font></a></li>
																		<li><a href="#mlien112"><font color="#000000">1.1.2 Delete Game</font></a></li>
																		<li><a href="#mlien113"><font color="#000000">1.1.3 Change game status</font></a></li>
																		<li><a href="#mlien114"><font color="#000000">1.1.4 Add or delete user of game</font></a></li>
																		<li><a href="#mlien115"><font color="#000000">1.1.5 See game results</font></a></li>
																	</ul>
																<li><a href="#mlien12"><font color="#000000">1.2 Manage plant</font></a></li>
																<ul>
																	<li><a href="#mlien121"><font color="#000000">1.2.1 Add plant</font></a></li>
																	<li><a href="#mlien122"><font color="#000000">1.2.2 Add type plant</font></a></li>
																</ul>
															</ul>
														</ul>
													</section>
													
													<section>
														<h3>For further questions, please send us an email at:</h3>
														<ul class="links">
															<li><strong>robin.roche@utbm.fr</strong></li>
														</ul>
													</section>
											</div>
										</div>
										<div class="8u  12u(narrower) important(narrower)">
											<div id="content">
												<!-- Content -->
													<article>
														<header>
															<h2>The ETSIM Manager Guide describes the following aspects:</h2>
															<ul class="links">
																<li>Manage game (add, delete, modify)</li>
																<li>Add user in game</li>
																<li>Delete user from game</li>
																<li>Manage plant and type</li>
															</ul>
														</header>
														<h2 id="mlien1">1 Manage panel</h2>
														<h3 id="mlien11">1.1 Manage game</h3>
														<span class="image featured"><img src="images/GameManage.JPG" alt="" /></span>
														<p>Figure 1: Game manage</p>
														<h1 id="mlien111">1.1.1 Add game</h1>
														<p>Add new game, juste click button « New Game »</p>
														<span class="image featured"><img src="images/NewGame.JPG" alt="" /></span>
														<p>
															<li>Enter description,</li>
															<li>Password for registration of user,</li>
															<li>Max player if necessary,</li>
															<li>Click add for submit.</li>
														</p>
														<span class="image featured"><img src="images/NewGameP.JPG" alt="" /></span>
														<p>Figure 2: New game</p>
														<h1 id="mlien112">1.1.2 Delete game</h1>
														<p>
															This action is irreversible and will completely delete a game (all data concerning this game will destroy : users assigned, game data,…) :
															<li>Select the game to remove,</li>
															<li>Click on Delete button.</li>
														</p>
														<h1 id="mlien113">1.1.3 Change game status</h1>
														<p>
															Three different status exists for a game in ETSIM:
															<li>Open: default status at creation,</li>
															<li>Play: status that should be updated by the Game Manager when the game begins,</li>
															<li>Close : If this game is temporary create,</li>
															<li>Completed: status when the game is finished that allows the Game Manager and the players to view the full results.</li>
														</p>
														<p>
															This section allows the Game Manager to change the game status (Open/Play/Close/Completed).
															To do so:
															<li>Chose game to change,</li>
															<li>In the input select, chose the new status for the game,</li>
															<li>The new status has been automatically update.</li>
														</p>
														<h1 id="mlien114">1.1.4 Add or delete user of game</h1>
														<p>Add player in game:</p>
														<span class="image featured"><img src="images/ListeBoxA.JPG" alt="" /></span>
														<p>Figure 3: Add user in game</p>
														<p>
															<li>Select player in table «  Player out game »,</li>
															<li>Click in the left button for add.</li>
														</p>
														<span class="image featured"><img src="images/ADD.JPG" alt="" /></span>
														<p>Add player in game:</p>
														<span class="image featured"><img src="images/ListeBoxD.JPG" alt="" /></span>
														<p>Figure 4: Delete user of game</p>
														<p>
															<li>Select player in table «  Player in game »,</li>
															<li>Click in the right button for delete.</li>
														</p>
														<span class="image featured"><img src="images/DEL.JPG" alt="" /></span>
														<h1 id="mlien115">1.1.5 See game results</h1>
														<p>If you want show the result of completed game or current game, you can just click of button view :</p>
														<span class="image featured"><img src="images/ShowGame.JPG" alt="" /></span>
														<h2 id="mlien12">1.2 Manage plant</h2>
														<h1 id="mlien121">1.2.1 Add plant</h1>
															<span class="image featured"><img src="images/PlantManage.JPG" alt="" /></span>
															<p>Figure 5: Manage plant</p>
															<p>
																If necessary, we can add new plant in our game or change data on a plant (automatically change in the database). For add new plant :
																<li>Click button « New plant »,</li>
																<li>Select type plant,</li>
																<li>Enter information about new plant,</li>
																<li>Click ADD.</li>
															</p>
															<span class="image featured"><img src="images/AddNewPlant.JPG" alt="" /></span>
															<p>Figure 6: Add plant</p>
														<h1 id="mlien122">1.2.2 Add plant</h1>
														<span class="image featured"><img src="images/TypePlantManage.JPG" alt="" /></span>
														<p>Figure 7: Manage type plant</p>
														<p>
															If necessary, we can add new plant in our game or change data on a plant (automatically change in the database). For add new plant :
															<li>Click button « New type »,</li>
															<li>Enter information about new type plant,</li>
															<li>Click ADD.</li>
														</p>
														<span class="image featured"><img src="images/AddTypePlantManage.JPG" alt="" /></span>
														<p>Figure 8: Add type plant</p>
												</article>
											</div>
										</div>
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>		
			<?php else : ?>
				<section class="wrapper style1 min-width="800px" width="30%" max-width="1000px">
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