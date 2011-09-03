<html>
    <head>
        <title>HARDCORE MODE! Kick some ass!</title>
		<link href="/game/inc/css/hardcore.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="/include/footercss.css">
		<script src="http://arflux-rpg.com/game/inc/soundmanager2-jsmin.js"></script>
		<script src="http://arflux-rpg.com/game/inc/berniecode-animator.js"></script>
		<script src="http://arflux-rpg.com/game/inc/360player.js"></script>
		<script type="text/javascript">
			soundManager.url = 'http://arflux-rpg.com/game/inc/';
			soundManager.flashVersion = 8; // optional: shiny features (default = 8)
			soundManager.useFlashBlock = false; // optionally, enable when you're ready to dive in
			soundManager.onready(function() {
				
			});
			threeSixtyPlayer.config = {
				playNext: true, // stop after one sound, or play through list until end
				autoPlay: true, // start playing the first sound right away
				allowMultiple: true, // let many sounds play at once (false = one at a time)
				loadRingColor: '#000', // amount of sound which has loaded
				playRingColor: '#ff0000', // amount of sound which has played
				backgroundRingColor: '#eee', // "default" color shown underneath everything else
				animDuration: 500,
				animTransition: Animator.tx.bouncy // http://www.berniecode.com/writing/animator.html		
			}
		</script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://arflux-rpg.com/game/inc/jquery.animate-shadow-min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var uid = <? echo $user->hardcore['id']?>, data, refresh;
								
				//initialize
				for(i = 0; i <=5; i++)
				{
					load_opponent();
				}
				
				animate_ranks(<? echo $user->rank['manliness_progress'];?>,<? echo $user->rank['richliness_progress'];?>);
				
				function load_opponent()
				{
					data = 'uid=' + uid + '&type=enemy';
					$.getJSON('http://arflux-rpg.com/game/index.php/handler/request', data, function(data){
						if (data.success == true)
						{
							$("#enemy_list").append("<div id='" + data.id + "' class='fanwood enemy'><img class='enemy_image' src='http://dummyimage.com/100x100/000/fff&text=100x100' /><div class='enemy_name'>" + data.name + "</div><div class='enemy_manliness'><span style='color:#ff0409; font-size: 14px; font-style: bold;'>Manliness</span> " + data.manliness + "</div></div>");
						}
						else
						{
							alert('ERR! ' + data.err);
						}
					});
				}
				
				function update()
				{
					data = 'uid=' + uid;
					$.getJSON('http://arflux-rpg.com/game/index.php/handler/update', data, function(data){
						//Fade out, update, and display manliness, ranks, and richliness
						$("#manliness_level_number").fadeOut(200, function(){
							$(this).html(data.manliness);
							$(this).fadeIn(200);
						});
						
						$("#richliness_level_number").fadeOut(200, function(){
							$(this).html(data.richliness);
							$(this).fadeIn(200);	
						});						
					});
				}
				
				function combat(data){
					$.getJSON('http://arflux-rpg.com/game/index.php/handler/combat', data, function(data){
						if (data.update_manliness_rank == true)
						{
							$("#manliness_level_title").fadeOut(200, function(){
								$(this).html(data.new_manliness_rank);
								$(this).fadeIn(200);
							});
						}
						if (data.update_richliness_rank == true)
						{
							$("#richliness_level_title").fadeOut(200, function(){
								$(this).html(data.new_richliness_rank);
								$(this).fadeIn(200);
							});
						}
						update();
						animate_ranks(data.manliness_progress, data.richliness_progress);
						if(data.success == true)
						{
							refresh = true;
						}
						else 
						{
							refresh = false;	
						}
					});
				}
				
				$(".enemy").live('click', function(){
					combat('uid='+uid + "&enemy_id=" + $(this).attr('id'));
					if (refresh == true)
					{
						$(this).fadeOut(100, function(){
							$(this).remove();
							load_opponent();
						});
					}
				});
				$(".enemy").live('mouseenter', function(){ 
  					$(this).animate({
  						boxShadow: '0 0 5px #f00',
  					}, 200);
					}).live('mouseleave', function(){
  					$(this).animate({
						boxShadow: '0 0 0px #0c0c0c',
					}, 200);
				});

				
				function animate_ranks(manliness_progress, richliness_progress){
					//Find percentage, modify it to fit the 225 width bar, animate
					
					if (manliness_progress != -1)
					{
						$('#manliness_level_overlay').animate({
					   		width: manliness_progress,
						}, 1000);
					}
					if (richliness_progress != -1)
					{
						$('#richliness_level_overlay').animate({
					   		width: richliness_progress,
						}, 1000);					
					}
				}
				
				$("#users_header").click(function(){
					$("#user_list").slideToggle(500);
				});
				
				$("#monsters_header").click(function(){
					$("#enemy_list").slideToggle(500);
				});
				
			});
		</script>
	</head>
    <body>
    	<div style="float: left; position: relative; left: 50%;">
			<div id="container">
				<div id="playlist" class="ui360">
					<?
						foreach($songs as $songs)
						{
							echo "{$songs}\n";
						}
					?>
				</div>
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
								<div class="fanwood content_header"><a id="monsters_header" href="#">Enemies</a></div>
								<div id="enemy_list">
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
										<?echo "<span id='manliness_level_info' class='fanwood subtitle'><span id='manliness_level_title'>{$user->rank['manliness']['name']}</span></span>";?>
										<div id='manliness_level_number' class="fanwood exp"><? echo $user->hardcore['manliness'];?></div>
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
										<?echo "<span id='richliness_level_info' class='fanwood subtitle'><span id='richliness_level_title'>{$user->rank['richliness']['name']}</span></span>";?>
										<div id='richliness_level_number' class="fanwood exp"><? echo $user->hardcore['richliness'];?></div>
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
		<script src="/include/jquery.zrssfeed.min.js" type="text/javascript"></script>
		<script src="/include/jquery.vticker.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function($){
			//Start feeds
			$('#ticker1').rssfeed('http://arflux-rpg.com/forum/syndication.php').one('ajaxStop', function() {
				$('#ticker1 div.rssBody').vTicker({ showItems: 2});
			});
		
			$('#ticker2').rssfeed('http://arflux-rpg.com/blog?feed=rss2').one('ajaxStop', function() {
				$('#ticker2 div.rssBody').vTicker({ showItems: 2});
			});	
		});
		</script>
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