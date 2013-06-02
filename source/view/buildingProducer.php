<?php

/**
 * @var string $title
 * @var Resource_Interface[] $goods
 */

$content = '';
foreach ($goods as $resource) {
	$content .= $resource->key() . '<br>';
}

$buildingBox = ViewHelper_ContentBox::create($title, $content);

echo "
{$buildingBox}
<script type='text/javascript'>
	$('#buildingBox').buildingBox();
</script>";