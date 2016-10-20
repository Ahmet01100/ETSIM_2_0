<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 02-01-2016
*/ ?>
<head>
	<title>Serious Game by UTBM</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="/assets/css/flipclock.css">
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/formValidation.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script src="/assets/js/flipclock/flipclock.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			var clock;
			
			idR = $('.clock').attr('id');
			idRP = parseInt(idR);
			idRG = $('.head_idGame').attr('id');
			idRGR = $('.round_number').attr('id');

			clock = $('.clock').FlipClock({
		        clockFace: 'MinuteCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		$('.message').html('Time out for this round!')
		        	}
		        }
			});
			
			if ( idRP < 0) {
				time = Math.floor((Math.random() * 10000) + 1);
				setTimeout(function(){},time);
				$.post('includes/update_InGame_data.php?Mgame_id='+idRG+'&Mround_number='+idRGR,function(data){
					setTimeout(function(){},3000);
					window.location.reload();
				});
				window.location.reload();
			} else {
				clock.setTime(idRP);
				clock.setCountdown(true);
				clock.start();
			}
	
			$("#anc_add").click(function(){
				valG = $('.idetsimgame_etsim_round_game').val();
				valM = $('.idetsimmember_etsim_round_game').val();
				valR = $('.round_number').attr('id');
				valD = $('.demand_power').attr('id');
				line = $('.line_etsim_round_game').val();

				$.post('includes/update_InGame_data.php?game_id='+valG+'&user_id='+valM+'&round_number='+valR+'&line_number='+line+'&demand='+valD,function(data){
					window.location.reload();
				});
				
			});
			 
			$("#anc_rem").click(function(){
				valG = $('.idetsimgame_etsim_round_game').val();
				valM = $('.idetsimmember_etsim_round_game').val();
				valR = $('.round_number').attr('id');
				line = $('.delete_line_etsim_round_game').val();
				$.post('includes/update_InGame_data.php?Dgame_id='+valG+'&Duser_id='+valM+'&Dround_number='+valR+'&Dline_number='+line,function(data){
					window.location.reload();
				});
			});
			
			$('table tr input').change(function(){
				valG = $('.idetsimgame_etsim_round_game').val();
				valM = $('.idetsimmember_etsim_round_game').val();
				valR = $('.round_number').attr('id');
				idLR = $(this).attr('id');
				class_ = $(this).attr('class');
				value = $(this).val();
				
				if ( ( class_ == 'bid_price_etsim_round_game_temp' ) && ( value > 180 ) ) {
					alert("your bid price must be lesser than 180");
					window.location.reload();
					return;
				}
				
				$.post('includes/update_InGame_data.php?Uval='+value+'&Ucol='+class_+'&Ugame_id='+valG+'&Uuser_id='+valM+'&Uround_number='+valR+'&Uline_number='+idLR,function(data){
					// window.location.reload();
				});
			});
			
			$('.ListeBoxPlants').change(function(){
				valG = $('.idetsimgame_etsim_round_game').val();
				valM = $('.idetsimmember_etsim_round_game').val();
				valR = $('.round_number').attr('id');
				idLR = $(this).attr('id');
				class_ = $(this).children(":selected").attr('class');
				value = $(this).children(":selected").attr('id');
				
				$.post('includes/update_InGame_data.php?LUval='+value+'&LUcol='+class_+'&LUgame_id='+valG+'&LUuser_id='+valM+'&LUround_number='+valR+'&LUline_number='+idLR,function(data){
					// window.location.reload();
				});
			});
			
			$("#ConfirmValueForRound").click(function(){
				valG = $('.idetsimgame_etsim_round_game').val();
				valM = $('.idetsimmember_etsim_round_game').val();
				valR = $('.round_number').attr('id');
				$.post('includes/update_InGame_data.php?Cgame_id='+valG+'&Cuser_id='+valM+'&Cround_number='+valR,function(data){
					window.location.reload();
				});
			});	
		});
	</script>
</head>