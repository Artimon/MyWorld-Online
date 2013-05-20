<?php

echo "
<!DOCTYPE html>
<html>
<head>
	<title>{$pageTitle}</title>

	<link rel='stylesheet' type='text/css' href='page.css'>

	<link rel='stylesheet' type='text/css' href='mwo/src/page.css'>
</head>
<body>
	<div>
		<!--<div id='background'></div>-->

		<div class='ringmenu'>
			<div>
				<figure class='entypo-address' title='Map' style='-webkit-transform: rotateY(0deg) translateZ(200px);'></figure>
				<figure class='entypo-list' title='Ranks' style='-webkit-transform: rotateY(72deg) translateZ(200px);'></figure>
				<figure class='entypo-feather' title='Messages' style='-webkit-transform: rotateY(144deg) translateZ(200px);'></figure>
				<figure class='entypo-tools' title='Settings' style='-webkit-transform: rotateY(216deg) translateZ(200px);'></figure>
				<figure class='entypo-logout' title='Logout' style='-webkit-transform: rotateY(288deg) translateZ(200px);'></figure>
			</div>
		</div>

		<div class='contextMenu'>
			<div class='circle'>Label</div>
			<a class='item i1 entypo-feather'></a>
			<a class='item i2 entypo-cog'></a>
			<a class='item i3 entypo-star'></a>
		</div>

		<form>
			<div class='validate'>
				<input type='text'>
				<div>Error Message</div>
			</div>
		</form>
	</div>

	<script type='text/javascript' src='ext/jQuery/jquery-1.8.0.min.js'></script>
	<script type='text/javascript' src='adframe.js'></script>
	<script type='text/javascript' src='default.js'></script>
</body>
</html>";