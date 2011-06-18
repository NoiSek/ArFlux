<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(
				var listcount = 0;
				while (listcount != 6)
				{
					get_enemy();
				}
				
				function get_enemy() {
					var query = 'manliness=<?$manliness?>';
					$.get('index.php/getenemy', query, function(data){
						$("user_list").append(data);
					});
				}
				
				$('#users_header').click(function(
					$('#user_list').slideToggle(500);
				));
				
				$('#enemies_header').click(function(
					$('#enemy_list').slideToggle(500);
				));
				

			));
		</script>
	</head>
    <body style="background: url('/game/inc/images/concrete_wall.png');">
		<div id="container">
			<div id="header"></div>
			<div id="content">
				<span id="left">
					<div id="combat">
						<div id="users">
							<div class="fanwood content_header"><a id="users_header" href="#hide_users">Users</a></div>
							<div id="user_list">
							</div>
						</div>
						<div id="Enemies">
							<div class="fanwood content_header"><a id="enemies_header" href="#hide_enemies">Enemies</a></div>
							<div id="enemy_list"></div>
						</div>
					</div>
				</span>
				<span id="right">
					<div id="info">
						<div align="center" id="username" class="fanwood"><?echo $username;?></div>
						<div id="manliness" class="blackout stat"><div>Manliness</div><img src="/game/inc/images/manliness.png" class="stat_icon" /><?echo $manliness?></div>
						<div id="money" class="blackout stat"><div>Money</div><img src="/game/inc/images/richliness.png" class="stat_icon" /><?echo $money?></div>
					</div>
					<div id="stats">
					</div>
				</span>
			</div>
		</div>
	</body>
</html>