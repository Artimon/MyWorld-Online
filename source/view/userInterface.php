<?php

$contentBox = ViewHelper_ContentBox::create('Default content box', 'Content box content.')
	->setActions("<button>Action</button>")
	->get();

$attentionBox = ViewHelper_ContentBox::create('Attention content box', 'Content box content.')
	->setAttention()
	->get();

echo "
<h2>User Interface Reference</h2>

<h3>Headlines</h3>
<p>
	<h1>Headline 1st order</h1>
	<h2>Headline 2nd order</h2>
	<h3>Headline 3rd order</h3>
	<h4>Headline 4th order</h4>
</p>

<h3>Content Box</h3>
<p>
	{$contentBox}
</p>

<h3>Attention Box</h3>
<p>
	{$attentionBox}
</p>

<h3>Context Menu</h3>
<p>
	<div class='contextMenu'>
		<div class='circle'>Label</div>
		<a class='item i1 entypo-feather'></a>
		<a class='item i2 entypo-cog'></a>
		<a class='item i3 entypo-star'></a>
	</div>
</p>

<h3>Form Elements</h3>
<p>
	<form>
		<div class='validate'>
			<input type='text'>
			<div>Error Message</div>
		</div>
	</form>
</p>";