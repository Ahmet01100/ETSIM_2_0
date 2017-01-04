<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 02-01-2016
*/ ?>
<head>
	<title>Serious Game by UTBM</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->	
	<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.dropotron.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>
		<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>			
		<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
		
		<script src="assets/js/flipclock/flipclock.min.js"></script>	
	<script>
		$(document).ready(function(){					
			$('.join_etsim_game').click(function(){
				idg = $(this).attr('id');
				password = $('#'+idg+'.password_etsim_game').val();
				$.post('includes/registeringame.inc.php?jgame_id='+idg+'&jpassword='+password,function(data){
					window.location.reload();
				});
			});
				
			$('.leave_etsim_game').click(function(){
				idg = $(this).attr('id');			
				$.post('includes/leavegame.inc.php?lgame_id='+idg,function(data){
					window.location.reload();
				});
			});
		});
	</script>			
</head>