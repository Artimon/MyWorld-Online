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

	<script type='text/javascript' src='ext/jQuery/jquery-1.8.0.min.js'></script>
	<script type='text/javascript' src='adframe.js'></script>
	<script type='text/javascript' src='default.js'></script>
</body>
</html>";