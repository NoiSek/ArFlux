<html>
    <head>
        <title>ArFlux RPG - A browser based interactive story!</title>
		<link href="/game/inc/css/global.css" rel="stylesheet" type="text/css">
	</head>
    <body>
		<div id="container">
			<div id="left_col">
				<div id="header">
					<img src="/inc/images/logo.png" />
				</div>
				<div id="photos">
					<?echo $photos?>
				</div>
				<div id="challenges">
					<?echo $challenges?>
				</div>
			</div>
			<div id="right_col">
				<?echo $right_column;?>
			</div>
		</div>
	</body>
</html>