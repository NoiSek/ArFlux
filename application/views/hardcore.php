<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(
				/*var listcount = 0;
				while (listcount != 6)
				{
					get_enemy();
				}
				
				function get_enemy() {
					var query = 'manliness=//<$manliness?>';
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
				

			));*/
		</script>
	</head>
    <body>
    	<div style="float: left; position: relative; left: 50%;">
			<div id="container">
				<div id="header"></div>
				<div id="content">
					<div id="left">
						<div id="combat">
							<div id="users">
								<div class="fanwood content_header"><a id="users_header" href="#">Users</a></div>
								<div id="user_list">
								</div>
							</div>
							<div id="Enemies">
								<div class="fanwood content_header"><a id="enemies_header" href="#">Enemies</a></div>
								<div id="enemy_list"></div>
							</div>
						</div>
					</div>
					<div id="right">
						<div id="info">
							<div id="manliness">
								<div id="manliness_number" class="blackout stat">Manliness</div>
								<div id="manliness_stats">
									<img id="manliness_image" src="/game/inc/images/manliness.png"/>
									<div id="manliness_level">
										<?echo "<span id='manliness_title' class='fanwood subtitle'>{$manliness} - {$manliness_rank}</span>"?>
										<div id="manliness_level_overlay"></div>
										<div id="manliness_level_bar"></div>						
									</div>
								</div>
							</div>
							<div id="richliness">
								<div id="richliness_number" class="blackout stat">Richliness</div>
								<div id="richliness_stats">
									<img id="richliness_image" src="/game/inc/images/richliness.png"/>
									<div id="richliness_level">
										<?echo "<span id='manliness_title' class='fanwood subtitle'>{$richliness} - {$richliness_rank}</span>"?>
										<div id="richliness_level_overlay"></div>
										<div id="richliness_level_bar"></div>						
									</div>
								</div>
							</div>
						</div>
						<div id="stats">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>