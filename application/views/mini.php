<html>
    <head>
        <title>ArFlux RPG - A browser based interactive story!</title>
		<link href="/game/inc/css/global.css" rel="stylesheet" type="text/css">
		<link type="text/css" href="style/jquery.jscrollpane.css" rel="stylesheet" media="all" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
		<script type="text/javascript" src="/game/inc/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="/game/inc/jquery.jscrollpane.min.js"></script>
	</head>
    <body>
		<div id="container">
			<span id="left_col">
				<div id="header">
					<img id="logo" src="/game/inc/images/logo.png" />
				</div>
				<div id="content">
						<div id="users">
							<select>
								<?
									foreach($users as $user_list)
									{
										echo "<div id='{$user_list['username']}' class='list_item' manliness='{$user_list['manliness']}' type='user'></div>";
									}
								?>
							</select>
						</div>
						
						<div id="monsters" action="">
							<?
								foreach($monsters as $monster_list)
								{
									echo "
									<div id='{$monster_list['name']}' class='list_item' manliness='{$monster_list['manliness']}' description='{$monster_list['description']}' type='monster'>
										<div class='avatar'>
											<img src='/game/inc/images/monsters/{$monster_list['id']}.png'>
										</div>
										<div class='blackout opponent_name'>
											$monster_list['name']
										</div>
										<div class='manliness'>
											$monster_list['manliness'];
										</div>
										<div class='reward'>
											#monster_list['reward']
										</div>
									</div>";
								}
							?>
						</div>
				</div>
			</span>
			<span id="right_col">
				<div align="center" id="username" class="fanwood"><?echo $username;?></div>
				<div id="manliness" class="fanwood stat"><div>Manliness</div><img src="/game/inc/images/manliness.png" class="stat_icon" /><?echo $manliness?></div>
				<div id="money" class="fanwood stat"><div>Money</div><img src="/game/inc/images/gold.png" class="stat_icon" /><?echo $money?></div>
			</span>
		</div>
	</body>
</html>