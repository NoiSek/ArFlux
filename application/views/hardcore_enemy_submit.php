<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#submit_enemy").submit(function(e){
					e.preventDefault();
					var query = $(this).serialize();
					$.getJSON('http://arflux-rpg.com/game/index.php/handler/submit', query, function(data){
						if (data.success == true)
						{
							$("#messages").html("Success. " + data.name + " created.").css({'color' : 'green'});
						}
						else
						{
							$("#messages").html("Error: " + data.err).css({'color' : 'red'});
						}
       					$("#messages").show(500).delay(5000).slideToggle(500);	
					});
       			});
			});
		</script>
	</head>
    <body>
    	<div style="float: left; position: relative; left: 50%;">
			<div id="container">
				<div id="header"></div>
				<div id="content">
					<div id="left" style="width: 100%;">
						<form id="submit_enemy" action="#" style="border-radius: 2px; background: #ABABAB; margin: 0 auto; width: 50%; margin-top: 100px; margin-bottom:100px;">
							<div style="display: block; border-radius: 2px; width:100%; height: 50px; background: #2d2d2d; font-size: 30pt; text-align: center;" class="blackout">Submit An Enemy</div>
							<div id="messages" style="display: none; margin: 0 auto; padding:10px;">Default</div>
							<div id='form_content'>
								<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px;">Enemy Name</div> 
								<input type="text" name="name" style="margin-left: 20px"></input>
								<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Manliness</div> 
								<input type="text" name="manliness" style="margin-left: 20px"></input>
								<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Manliness Reward</div> 
								<input type="text" name="manliness_reward" style="margin-left: 20px"></input>
								<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Richliness Reward</div> 
								<input type="text" name="richliness_reward" style="margin-left: 20px;"></input>
								<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Manliness Penalty</div> 
								<input type="text" name="manliness_penalty" style="margin-left: 20px"></input>
								<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Richliness Penalty</div> 
								<input type="text" name="richliness_penalty" style="margin-left: 20px; margin-bottom: 20px;"></input>
								<input type="hidden" name="author" value="<?echo $username?>"></input>
								<input id="submit" type="submit" name="submit" value="submit" style="margin-left: 20px; margin-bottom: 20px;"></input>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>