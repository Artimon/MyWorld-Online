<?php

$titleBoxContent = "
*some theme images*
<br>
Create your own browsergame world and play it with your friends!";

$titleBox = ViewHelper_ContentBox::create('', $titleBoxContent)
	->setClass('titleBox')
	->setSticky();

$registrationBox = ViewHelper_ContentBox::create(
	i18n('register'),
	'form'
)->setSticky()->setAttention();

$newsBox = ViewHelper_ContentBox::create(
	i18n('news'),
	'updates'
)->setSticky();

$loginBox = ViewHelper_ContentBox::create(
	i18n('login'),
	'should not be here an collapsed for unknown users'
)->setSticky();

echo "
<div id='login'>
	{$titleBox}
	<div id='title'>
		<h1>MyWorld-Online</h1>
		Erschaffe Deine Spielwelt
	</div>
	<div class='register'>
		{$registrationBox}
	</div>
	<div class='login'>
		{$loginBox}
	</div>
	<div class='news'>
		{$newsBox}
	</div>
</div>";