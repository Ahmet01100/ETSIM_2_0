<?php
include_once 'functions.php';
include_once 'db_connect.php';

if(!isset($_SESSION))
    sec_session_start();


    // Faire le insert
    
        if(isset($_POST['volumeInGame']) && isset($_POST['priceInGame']) && isset($_POST['plantList']) && isset($_POST['numRound']) && isset($_POST['demand']))
        {
            $reqMaxLine = "SELECT IFNULL(MAX(line_etsim_round_game_temp),0)+1 FROM etsim_round_game_temp 
                            WHERE idetsimgame_etsim_round_game_temp = :idEtsimGame AND number_etsim_round_game_temp = :numRound"; 
            $maxLine=1;
            if( $stmtMaxLine = $mysqli->prepare($reqMaxLine) ) {
                $stmtMaxLine->bindParam(':idEtsimGame', $_SESSION['id_etsim_game']);
                $stmtMaxLine->bindParam(':numRound', $_POST['numRound']);
                $stmtMaxLine->execute();
                $donnees = $stmtMaxLine->fetch();
                $maxLine = $donnees[0];
            }  
            echo 'id game:'.$_SESSION['id_etsim_game'].'<br/>';
            echo 'numRound:'.$_POST['numRound'].'<br/>';
            echo 'maxLine:'.$maxLine.'<br/>';
            
            /*echo $_POST['volumeInGame'];
            echo '<br/>';
            echo $_POST['priceInGame'];
            echo '<br/>';
            echo $_POST['plantList'];*/
            $insertRound = "INSERT INTO etsim_round_game_temp ( `idetsimgame_etsim_round_game_temp`, 
                                                        `idetsimmember_etsim_round_game_temp`, 
                                                        `number_etsim_round_game_temp`, 
                                                        `line_etsim_round_game_temp`, 
                                                        `bid_volume_etsim_round_game_temp`, 
                                                        `bid_price_etsim_round_game_temp`, 
                                                        `demand_voume_etsim_round_game_temp`, 
                                                        `market_price_etsim_round_game_temp`, 
                                                        `income_etsim_round_game_temp`, 
                                                        `cost_etsim_round_game_temp`, 
                                                        `benefit_etsim_round_game_temp`, 
                                                        `capital_etsim_round_game_temp`,
                                                        `idplant_etsim_round_game_temp`,
                                                        `finnish_etsim_round_game_temp`)
                    VALUES (:idEtsimGame, :idUser, :nbRound, :line, :volume, :price, :demand, 1, 1, 1, 1, 1, :idEtsim, 0);";

            if( $stmtinsertRound = $mysqli->prepare($insertRound) ) {
                $stmtinsertRound->bindParam(':idEtsimGame', $_SESSION['id_etsim_game']);
                $stmtinsertRound->bindParam(':idUser', $_SESSION['user_id']);
                $stmtinsertRound->bindParam(':nbRound', $_POST['numRound']);
                $stmtinsertRound->bindParam(':line', $maxLine);
                $stmtinsertRound->bindParam(':volume', $_POST['volumeInGame']);
                $stmtinsertRound->bindParam(':price', $_POST['priceInGame']);
                $stmtinsertRound->bindParam(':demand', $_POST['demand'] );
                $stmtinsertRound->bindParam(':idEtsim', $_POST['plantList']);
                
                
                $stmtinsertRound->execute();
            
            }           
                
        }


    header('Location: ../inGame.php#divInsertTable');
    exit;

?>