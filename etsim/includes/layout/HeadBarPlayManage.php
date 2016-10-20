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
		<link rel="stylesheet" href="/assets/css/flipclock.css">
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
				$('#new_game').click(function(){ 
					window.open('new_game.php','myWindow', "width=300, height=300");
				});
				
				$('.ListeBoxUsersContains').change(function(){
					idg = $(this).parent().parent().attr('id');
					class_ = $(this).attr('class');
					value = $(this).val();
					idc = $(this).children(":selected").attr('id');

					$('#btnRight').click(function(e) {
						$.post('includes/update_game_data.php?game_id='+idg+'&col='+class_+'&member_id='+idc,function(data){
							window.location.reload();
						});
					});
				});
					
				$('.ListeBoxUsersNotContains').change(function(){
					idg = $(this).parent().parent().attr('id');
					class_ = $(this).attr('class');
					value = $(this).val();
					idc = $(this).children(":selected").attr('id');

					$('#btnLeft').click(function(e) {
						$.post('includes/update_game_data.php?game_id='+idg+'&col='+class_+'&member_id='+idc,function(data){
							window.location.reload();
						});
					});
				});
					
				$('table tr input').change(function(){
					id = $(this).parent().parent().attr('id');
					class_ = $(this).attr('class');
					value = $(this).val();
					
					if(class_ == "description_etsim_game") {
						$.post('includes/update_game_data.php?ttiid='+id+'&tticol='+class_+'&ttival='+value,function(data){
							window.location.reload();
						});
					} else if ((class_ == "name_etsim_type_plant") || (class_ == "description_etsim_type_plant") || (class_ == "minv_costs_etsim_type_plant") || (class_ == "maxv_costs_etsim_type_plant")) {
						$.post('includes/update_type_plant_data.php?id='+id+'&col='+class_+'&val='+value,function(data){
							window.location.reload();
						});
					} else {
						$.post('includes/update_plant_data.php?id='+id+'&col='+class_+'&val='+value,function(data){
							window.location.reload();
						});
					}
						
				});
					
				$('.delete_etsim_game').click(function(){
					id = $(this).attr('id');
					class_ = $(this).attr('class');
					
					if(confirm("Do you want delete the game "+id+"?")){
						$.post('includes/update_game_data.php?id_game='+id+'&colo='+class_+'&delete=true',function(data){});
						$(this).parent().parent().fadeOut("slow",function(){});
						window.location.reload();
					}
				});
				
				$('.delete_etsim_plant').click(function(){
					id = $(this).attr('id');
					class_ = $(this).attr('class');
					
					if(confirm("Do you want delete the plant"+id+"?")){
						$.post('includes/update_plant_data.php?id_plant='+id+'&colo='+class_+'&delete=true',function(data){});
						$(this).parent().parent().fadeOut("slow",function(){});
						window.location.reload();
					}
				});
				
				$('.delete_etsim_type_plant').click(function(){
					id = $(this).attr('id');
					class_ = $(this).attr('class');
					
					if(confirm("Do you want delete the type plant "+id+"?")){
						$.post('includes/update_type_plant_data.php?id_type_plant='+id+'&colo='+class_+'&delete=true',function(data){});
						$(this).parent().parent().fadeOut("slow",function(){});
						window.location.reload();
					}
				});
					
				$('.status_etsim_game').change(function(){
					id = $(this).parent().parent().attr('id');
					class_ = $(this).attr('class');
					value = $(this).val();
					
					$.post('includes/update_game_data.php?ssid='+id+'&sscol='+class_+'&ssval='+value,function(data){
						window.location.reload();
					});
				});			
					
				$('.name_etsim_type_plant').change(function(){
					idp = $(this).parent().parent().attr('id');
					class_ = $(this).attr('class');
					value = $(this).val();
					idtp = $(this).children(":selected").attr('id');

					$.post('includes/update_plant_data.php?plant_id='+idp+'&tplant_id='+idtp,function(data){
						window.location.reload();
					});
				});
				
				$('#new_plant').click(function(){ 
					window.open('new_plant.php','myWindow', "width=300, height=300");
				});
				
				$('#new_type_plant').click(function(){ 
					window.open('new_type_plant.php','myWindow', "width=300, height=300");
				});
			});
			</script>			
</head>