<?php
include_once 'functions.php';
include_once 'functions_game.php';
include_once 'db_connect.php';

if(!isset($_SESSION))
    sec_session_start();

/*if(isset($_SESSION['id_etsim_game']) && isset($_POST['numRound'] ))
{
    // applyRoundGame($mysqli, $_SESSION['id_etsim_game'], $_POST['numRound']);
  /*  
    
   

}*/
  
$_SESSION['register_round'] = 'register_round';
header('Location: ../inGame.php#divInsertTable');
exit;
?>