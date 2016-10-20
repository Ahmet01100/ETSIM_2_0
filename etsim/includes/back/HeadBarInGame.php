<head>
	<title>Serious Game by UTBM</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="/assets/css/flipclock.css">
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script src="/assets/js/flipclock/flipclock.min.js"></script>	
	
	<script type="text/javascript">
		$(document).ready(function() {
			var clock;
			idR = $('.clock').attr('id');
			idRP = parseInt(idR);

			clock = $('.clock').FlipClock({
		        clockFace: 'MinuteCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		$('.message').html('Time out for this round!')
		        	}
		        }
			});
			if ( idRP == 0 ) {
				window.location = window.location.href;
			} else if ( idRP < 0) {
				clock.setTime(0);
			} else {
				clock.setTime(idRP);
				clock.setCountdown(true);
				clock.start();
			}
	
			var cnt = 2;
			$("#anc_add").click(function(){
				$('#tbl1 tr').last().after('<tr><td><input type="text" name="txtbx'+cnt+'" value="'+cnt+'"></td><td><input type="text" name="txtbx'+cnt+'" value="'+cnt+'"></td><td><input type="text" name="txtbx'+cnt+'" value="'+cnt+'"></td><td><input type="text" name="txtbx'+cnt+'" value="'+cnt+'"></td></tr>');
				cnt++;
			});
			 
			$("#anc_rem").click(function(){
				if($('#tbl1 tr').size()>1){
					$('#tbl1 tr:last-child').remove();
				}else{
					alert('One row should be present in table');
				}
			});
		});
	</script>
</head>