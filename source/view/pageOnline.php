<?php

/**
 * @var string $pageTitle
 * @var string $body
 */

echo "
<!DOCTYPE html>
<html>
<head>
	<title>{$pageTitle}</title>

	<link rel='stylesheet' type='text/css' href='mwo/src/page.css'>
</head>
<body>
	<div class='content'>{$body}</div>

	<div class='navigation'>
		<a href='#' class='round entypo-home'></a>
		<a href='#' class='round entypo-users'></a>
		<a href='#' class='round entypo-star-empty'></a>
		<a href='#' class='round entypo-feather'></a>
		<a href='#' class='round entypo-cog'></a>
	</div>

	<script type='text/javascript' src='ext/jQuery/jquery-1.8.0.min.js'></script>
	<script type='text/javascript' src='adframe.js'></script>
	<script type='text/javascript' src='default.js'></script>
</body>
</html>";