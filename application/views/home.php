<html>
    <head>
        <title>ArFlux RPG - A browser based interactive story!</title>
		<link href="/game/inc/css/global.css" rel="stylesheet" type="text/css">
	</head>
    <body>
		<div id="container">
			<div id="header">
				<img id="logo" src="/game/inc/images/logo.png" />
			</div>
			<?
				echo "<div id='welcome' class='fanwood'>Welcome back, $username</div>";
				echo "<div id='user_feed'>";
				/*foreach($user_feed as $feed_item)
				{
					echo "<div id='feed_item'>
							<img id='photo' src=\"/inc/images/photos/{$feed_item['image_id']}.png\"/>
							<span id='challenge_description'>{$feed_item['description']}</span>
						</div>";
				}*/
				echo "<div class='challenge_description'>Lorem ipsum dolor set amet nigga bitch cunt fuck cock driving drivers driven driver computer cash speaker when I fell down the stairs.</div>";
				echo "</div>";
			?>
		</div>
	</body>
</html>