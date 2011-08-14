<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){				
				var data = 'manliness=' + $("#manliness_level_number").html() + '&type=enemy';
				load_opponents();
				//data = 'manliness=' + $("#manliness_level_number").html() + '&type=user';
				//load_opponents();
				function load_opponents()
				{
					$.getJSON('http://arflux-rpg.com/game/index.php/handler/request', data, function(data){
						if (data.success == true)
						{
							$("#enemy_list").append("<div id='" + data.name + "' class='enemy'><img class='enemy_image' src='http://dummyimage.com/100x100/000/fff&text=100x100' /><div class='enemy_manliness'>" + data.manliness + "</div><div class='enemy_richliness_reward'>"+data.richliness_reward+"</div><div class='enemy_manliness_reward'>"+data.manliness_reward+"</div></div>");
						}
						else
						{
							alert('Failed to load enemies and users! ' + data.err);
						}
					});
				}
				
				/*$('#manliness_level_overlay').animate({
				   width: ,
				 }, 5000, function() {
				   // Animation complete.
				 });
				  
				$('#richliness_level_overlay').animate({
				   width: ,
				 }, 5000, function() {
				   // Animation complete.
				 });*/
				  
				$("#users_header").click(function(){
					$("#user_list").slideToggle(500);
				});
				
				$("#enemies_header").click(function(){
					$("#enemy_list").slideToggle(500);
				});
			});
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
								<div id="enemy_list">
									<div id="Crying Baby" class="enemy">
										<img class="enemy_image" src="http://dummyimage.com/100x100/000/fff&text=100x100" />
										<div class="enemy_manliness"></div>
										<div class="enemy_richliness_reward"></div>
										<div class="enemy_manliness_reward"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="right">
						<div id="info">
							<div id="manliness">
								<div id="manliness_title" class="blackout stat">Manliness</div>
								<div id="manliness_stats">
									<img id="manliness_image" src="/game/inc/images/manliness.png"/>
									<div id="manliness_level">
										<?echo "<span id='manliness_level_info' class='fanwood subtitle'><span id='manliness_level_number'>{$user->hardcore['manliness']}</span> - <span id='manliness_level_title'>{$user->rank['manliness']['name']}</span></span>";?>
										<div id="manliness_level_overlay"></div>
										<div id="manliness_level_bar"></div>						
									</div>
								</div>
							</div>
							<div id="richliness">
								<div id="richliness_title" class="blackout stat">Richliness</div>
								<div id="richliness_stats">
									<img id="richliness_image" src="/game/inc/images/richliness.png"/>
									<div id="richliness_level">
										<?echo "<span id='richliness_level_info' class='fanwood subtitle'><span id='richliness_level_number'>{$user->hardcore['richliness']}</span> - <span id='richliness_level_title'>{$user->rank['richliness']['name']}</span></span>";?>
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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
		<script src="/include/jquery.zrssfeed.min.js" type="text/javascript"></script>
		<script src="/include/jquery.vticker.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function () {
			$('#ticker1').rssfeed('http://arflux-rpg.com/forum/syndication.php').ajaxStop(function() {
				$('#ticker1 div.rssBody').vTicker({ showItems: 2});
			});
		
			$('#ticker2').rssfeed('http://arflux-rpg.com/blog?feed=rss2').ajaxStop(function() {
				$('#ticker2 div.rssBody').vTicker({ showItems: 2});
			});
		});
		</script>
		
		<link rel="stylesheet" type="text/css" href="/include/footercss.css">
		
		<div id="real_footer">
			<div id="columns">
				<span id="fleft">
					<div class="col_head">Our Network</div>
		
					<div class="column_content">
						<ul id="sitenav" type="square">
							<li><a href="http://arflux-rpg.com">Home</a></li>
							<li><a href="http://arflux-rpg.com/game">Game</a></li>
							<li><a href="http://arflux-rpg.com/forum">Forum</a></li>
							<li><a href="http://arflux-rpg.com/wiki">Wiki</a></li>
							<li><a href="http://arflux-rpg.com/blog">Development Blog</a></li>
		
							<li><a href="http://arflux-rpg.com/todo">Public ToDo List</a></li>
							<li><a href="http://arflux-rpg.com/forum/misc.php?page=chat">Chat</a></li>
						</ul>
					</div>
				</span>
				
				<span id="fcenter">
					<div class="col_head">Latest Posts</div>
		
					<div class="column_content">
						<div id="ticker1"></div>
					</div>
				</span>
				
				<span id="fright">
					<div class="col_head">Blogfeed</div>
					<div class="column_content">
						<div id="ticker2"></div>
		
					</div>
				</span>
			</div>
		<div>
	</body>
</html>