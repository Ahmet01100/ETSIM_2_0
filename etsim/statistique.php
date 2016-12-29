<!DOCTYPE html>
<html >
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
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="includes/chart/js/highcharts.js"></script>
        <script src="includes/chart/js/modules/exporting.js"></script>
        

        <?php 
       
        include('includes/containerChart.inc.php'); 
        include_once 'includes/inGame.inc.php';
        ?>
    </head>
        <!-- Head Bar -->

	

    <body>
        <div id="divContent">
            <div id="containerLine" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        
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
        
    </body>
</html>