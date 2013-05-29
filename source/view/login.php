<?php

$titleBoxContent = "
*some theme images*
<br>
Create your own browsergame world and play it with your friends!";

$facebookSite = i18n('facebookSite');

$socialMedia = "
<div class='right'>
	<img src='mwo/img/facebook.png' alt='fb' title='{$facebookSite}'>
</div>";
$titleBox = ViewHelper_ContentBox::create($socialMedia, $titleBoxContent)
	->setClass('titleBox')
	->setSticky();


$emailOrName = i18n('emailOrName');
$password = i18n('password');
$login = i18n('login');

$loginBox = "
<form action='' method='post'>
	<div>
		{$emailOrName}
		<input type='text' name='name'>
	</div>
	<div>
		{$password}
		<input type='password' name='password'>
	</div>
	<div>
		<input type='submit' name='login' class='button important' value='{$login}'>
	</div>
</form>";
$loginBox = ViewHelper_ContentBox::create($login, $loginBox)->setClass('loginBox null');


$registrationBox = ViewHelper_ContentBox::create(
	i18n('register'),
	"form<br><a href='#' class='button'>Los gehts!</a>"
)->setSticky()->setAttention();


$newsBox = ViewHelper_ContentBox::create(
	i18n('news'),
	"updates<br><a href='?r=ui'>User Interface</a>"
)->setSticky();


$infoBox = ViewHelper_ContentBox::create(
	i18n('info'),
	'info'
)->setSticky();

echo "
<div id='login'>
	{$titleBox}
	<div id='title'>
		<h1>MyWorld-Online</h1>
		<h2>Erschaffe Deine Spielwelt</h2>
	</div>
	<div class='login'>
		<a href='javascript:;' class='button important showLogin'>{$login}</a>
		{$loginBox}
	</div>
	<div class='register'>
		{$registrationBox}
	</div>
	<div class='info'>
		{$infoBox}
	</div>
	<div class='news'>
		{$newsBox}
	</div>
</div>";