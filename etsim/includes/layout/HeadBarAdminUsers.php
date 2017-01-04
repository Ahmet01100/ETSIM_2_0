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
			<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script> -->
			<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
			<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

			<script src="assets/js/flipclock/flipclock.min.js"></script>	
			<script>
				$(document).ready(function(){
					$('table tr input').change(function(){
						id = $(this).parent().parent().attr('id');
						class_ = $(this).attr('class');
						value = $(this).val();

						jQuery.validator.setDefaults({
							debug: true,
							success: "valid"
						});
						
						if ( class_ == "email_etsim_members") {
							// alert(class_);
							if (IsEmail(value)) {
									//aqui mi sentencia 
									// alert(class_);
								}
								else {
									alert("Mail is not valide ( ex: exemple@mail.fr ) ");
									window.location.reload();
									return;
								}
						}
						
						if ( class_ == "enable_etsim_members") {
							name=$(this).parent().parent().find('.username_etsim_members').val();
							id = $(this).parent().parent().attr('id');
							test = $(this).parent().parent().find('#with').val();
							
							if( test == 'on' ) {
								if(confirm("Voulez vous vraiment désactiver l'utilisateur "+name+"?")){
									value = 0;
								} else {
									window.location.reload();
									return;
								}
							} else {
								if(confirm("Voulez vous vraiment activer l'utilisateur "+name+"?")){
									value = 1;
								} else {
									window.location.reload();
									return;
								}
							}
						}
						
						if ( class_ ==  "role_etsim_members") {
							if ( (value.toLowerCase() != "Player".toLowerCase()) && (value.toLowerCase() != "Manager".toLowerCase()) && (value.toLowerCase() != "Admin".toLowerCase()) ) {
								alert("Only Player, Manager and Admin are available!");
								window.location.reload();
								return;
							}
						}
						
						$.post('includes/update_user_data.php?id='+id+'&col='+class_+'&val='+value,function(data){
							window.location.reload();
						});
					});
					
					$('table tr select').change(function(){
						id = $(this).parent().parent().attr('id');
						class_ = $(this).attr('class');
						value = $(this).val();
						
						$.post('includes/update_user_data.php?id='+id+'&col='+class_+'&val='+value,function(data){
							window.location.reload();
						});
					});

					$('.delete_etsim_members').click(function(){
						name=$(this).parent().parent().find('.username_etsim_members').val();
						id = $(this).parent().parent().attr('id');
						if(confirm("Voulez vous vraiment supprimer l'utilisateur "+name+"?")){
							$.post('includes/update_user_data.php?id='+id+'&delete=true',function(data){});
							$(this).parent().parent().fadeOut("slow",function(){});
						}
					});
					
					function IsEmail(email) {
						var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						return regex.test(email);
					}
				});
			</script>
	</head>