<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(

			));
		</script>
	</head>
    <body style="background: url('/game/inc/images/concrete_wall.png');">
		<div id="container">
			<div id="header"></div>
			<div id="content">
				<form id="submit_monster" action="" style="background: #fff;">
					<div style="display: block; width:100%; height: 20px; background: #c6c6c6;"></div>
					<div class="fanwood" style="font-size: 20px;">Enemy Name</div> 
					<input type="text" name="name"></input>
					<div class="fanwood" style="font-size: 20px;">Manliness</div> 
					<input type="text" name="manliness"></input>
					<div class="fanwood" style="font-size: 20px;">Manliness Reward</div> 
					<input type="text" name="manliness_reward"></input>
					<div class="fanwood" style="font-size: 20px;">Money Reward</div> 
					<input type="text" name="money_reward"></input>
					<input type="hidden" name="author" value="<?$username?>"></input>
				</form>
			</div>
		</div>
	</body>
</html>