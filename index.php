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
			if(isset($_GET['action'])){
				if(($_GET['action'] == "edit")){
					include_once('edit.php');
				}
			}
			else if(isset($_REQUEST['action'])){
				if(($_REQUEST['action'] == "edit")){
					include_once('edit.php');
				}			
			}
			else {
				include_once('lister.php');
			}
			
		?>
	</div>
</body>
</html>