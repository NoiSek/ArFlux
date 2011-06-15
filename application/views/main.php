<html>
    <head>
        <title>ArFlux RPG - A browser based interactive story!</title>
		<link href="/game/inc/global.css" rel="stylesheet" type="text/css">
	</head>
    <body>
		<div id="container">
			<?
				echo "<div class='fanwood'>Welcome back, $username</div>";
				foreach($user_feed as $feed_item)
				{
					echo "<div id='feed_item'>
							<img id='photo' src=\"/inc/images/photos/{$feed_item['image_id']}.png\"/>
							<>
						</div>";	
				}
			?>
		</div>
	</body>
</html>