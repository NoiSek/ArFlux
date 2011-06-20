<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(
				$("submit").click(function(){
					$('#submit_monster').slideToggle(500);
					$('#loading').slideToggle(500);
					var query = $('submit_monster').serialize();
					$.post('index.php/functions/submit', query, function(data, status){
						
					});
					$('#loading').slideToggle(500);
					$('#submit_monster').slideToggle(500);
				});
			));
		</script>
	</head>
    <body>
    	<div style="float: left; position: relative; left: 50%;">
			<div id="container">
				<div id="header"></div>
				<div id="content">
					<div id="left" style="width: 100%;">
						<div id="loading" display="hidden" style="display: block; background: #000; width: 100px; height: 100px; margin: 0 auto; margin-top: 100px; margin-bottom: 100px;">
							<img src="/game/inc/images/loading.gif" />
						</div>
						<form id="submit_monster" action="" style="background: #ABABAB; margin: 0 auto; width: 50%; margin-top: 100px; margin-bottom:100px;">
							<div style="display: block; width:100%; height: 50px; background: #666; font-size: 30pt; text-align: center; font-family: Arial;">Submit A Monster</div>
							<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px;">Enemy Name</div> 
							<input type="text" name="name" style="margin-left: 20px"></input>
							<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Manliness</div> 
							<input type="text" name="manliness" style="margin-left: 20px"></input>
							<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Manliness Reward</div> 
							<input type="text" name="manliness_reward" style="margin-left: 20px"></input>
							<div class="fanwood" style="font-size: 20px; margin-top: 20px; margin-left: 20px">Money Reward</div> 
							<input type="text" name="richliness_reward" style="margin-left: 20px; margin-bottom: 20px;"></input>
							<input type="hidden" name="author" value="<?$username?>"></input>
							<div style="margin-left: 20px; margin-bottom: 20px;"><input id="submit" type="submit" name="submit" value="submit"></input></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>