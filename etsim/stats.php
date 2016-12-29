<!DOCTYPE HTML>
<html>
    
<head>
<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    include_once 'includes/functions.php';
    if(!isset($_SESSION))
        sec_session_start();
    $idGame = $_SESSION['id_etsim_game'];
    $Uid = $_SESSION['user_id'];
    $roundGame=$_SESSION['roundGame'];
        
?>
        <title>Statistiques</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="assets/js/main.js"></script>

        <script src="/assets/js/flipclock/flipclock.min.js"></script>		
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="includes/chart/js/highcharts.js"></script>
        <script src="includes/chart/js/modules/exporting.js"></script>
    

        <?php 
        
        include('includes/containerChart.inc.php'); 
        include_once 'includes/inGame.inc.php';
        ?>
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="/assets/css/flipclock.css">
    </head>
    
    <body>
        <div id="page-wrapper">
             <!-- Navigation Bar -->
    <?php include_once 'includes/layout/NavigBar.php'; ?>        
    <!-- Login Bar -->
    <?php include_once 'includes/layout/LoginDiv.php'; ?>
        <!-- Results -->
            <section class="wrapper style1" min-width="300px" width="30%" max-width="1000px">
					<div class="container">
                        <h1 style="text-align: center">Final Score</h1>
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
                                //$currentStatusRoundGame = statusCurrentRoundGame($mysqli, $idGame, $roundGame);
                                CurrentGameResults($mysqli, $idGame);
                            ?>
                        </table>

                       
                </div>
                <div id="divContent">
                    <div id="containerLine" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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