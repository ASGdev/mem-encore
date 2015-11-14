<!doctype html>
<html>
<head>
	<script type="text/javascript" src="app.js"></script>
	<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<div id="header">
		<div>Mem'encore</div>
		<div id="action-quit" onclick="quit_test();">Quit test</div>
	</div>
	<div id="appcontent">
		<?php
			include_once('lister.php');
		?>

	</div>
</body>
</html>