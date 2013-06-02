<?php

/**
 * @var string $pageTitle
 * @var string $body
 */

$moreGames = i18n('moreGames');

$battleForKyoto = i18n('battleForKyoto');

$gameBox = "
	<ul class='gameList'>
		<li>
			<a href='http://www.schlacht-um-kyoto.de' target='_blank'>
				<img src='./mwo/img/suk_logo.png' alt='{$battleForKyoto}'
					title='{$battleForKyoto}'><br>
				{$battleForKyoto}
			</a>
		</li>
	</ul>
	<div class='clear'></div>";

$gameBox = ViewHelper_ContentBox::create('Browsergames', $gameBox)->get();

$bindings = JavaScript::getInstance()->bindings();

$products = "
	<div id='products'>
		<div class='content'>
			<div class='company'>
				<a href='http://www.pad-soft.de' target='_blank'>
					<span class='entypo-compass'></span>
					PAD-Soft Game Development by Artimus
				</a>
			</div>
			<div class='moreGames'>
				<div class='selectGames'>
					{$moreGames}
					&nbsp;
					<span class='entypo-down-open'></span>
				</div>
				<div class='gamesBoard null'>
					{$gameBox}
				</div>
			</div>
		</div>
	</div>";

echo "
<!DOCTYPE html>
<html>
<head>
	<title>{$pageTitle}</title>

	<link rel='stylesheet' type='text/css' href='mwo/src/page.css'>
</head>
<body>
	{$products}
	<div class='content'>{$body}</div>

	<script type='text/javascript' src='ext/jQuery/jquery-1.8.0.min.js'></script>
	<script type='text/javascript' src='mwo/src/adframe.js'></script>
	<script type='text/javascript' src='mwo/src/page.js'></script>
	<script type='text/javascript'>
		{$bindings}
	</script>
</body>
</html>";