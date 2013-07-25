<?php

/**
 * @var string $pageTitle
 * @var string $language
 * @var string $body
 */

$city = Theme::getInstance()->resolve('city');
$cityUrl = Router::build(array('city'));

$logout = i18n('logout');
$logoutUrl = Router::build(array('logout'));

$bindings = JavaScript::getInstance()->bindings();

echo "
<!DOCTYPE html>
<html ng-app='mwoApp'>
<head>
	<title>{$pageTitle}</title>

	<link rel='stylesheet' type='text/css' href='mwo/src/page.css'>
</head>
<body>
	<div class='content'>{$body}</div>

	<div class='navigation'>
		<a href='{$cityUrl}' class='round entypo-home' title='{$city}'></a>
		<a href='#' class='round entypo-users'></a>
		<a href='#' class='round entypo-star-empty'></a>
		<a href='#' class='round entypo-feather'></a>
		<a href='#' class='round entypo-cog'></a>
		<a href='{$logoutUrl}' class='round entypo-logout' title='{$logout}'></a>
	</div>

	<div id='response' class='null'></div>

	<script type='text/javascript' src='mwo/src/i18n/{$language}.js'></script>
	<script type='text/javascript' src='ext/jQuery/jquery-1.10.2.min.js'></script>
	<script type='text/javascript' src='ext/angular/angular.min.js'></script>
	<script type='text/javascript' src='mwo/src/page.js'></script>
	<script type='text/javascript'>
		{$bindings}
	</script>
</body>
</html>";