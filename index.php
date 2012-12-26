<!DOCTYPE html>
<html>
<head>
	<title>Uploading...</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="mobile.css" rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 959px)" /> 
	<link href="desktop.css" rel="stylesheet" type="text/css" media="Screen and (min-width: 960px)" />
</head>
<body style="font-family: monospace;">
	<div id="container">
		<?php require_once('connect.php'); ?>
		<div id="nav">
			<a id="title" href="./"><span>Uploading...</span></a><!-- space-fix
			--><a href="index.php">HOME</a><a href="?p=browse">BROWSE</a><a href="?p=administration">ADMIN</a><?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){ echo '<a href="index.php?p=logout">LOG OUT</a>'; } ?>
		</div>
		<div id="content">
			<?php if(!isset($_GET['p'])){ include_once("upload.php"); }else{ include_once($_GET['p'] . '.php'); } ?>
		</div>
	</div>
</body>
</html>