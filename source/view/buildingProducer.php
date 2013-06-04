<?php

/**
 * @var string $title
 * @var Resource_Interface[] $goods
 * @var int $cityId
 * @var int $position
 * @var bool $isWorking
 */

$content = '';
foreach ($goods as $resource) {
	$url = Router::build(array(
		'produce_' . $resource->key(),
		$cityId,
		$position
	));

	$disabled = $isWorking ? ' disabled' : '';

	$content .= "{$resource->name()} <a href='{$url}' class='produce button{$disabled}'>{$resource->createName()}</a><br>";
}

$buildingBox = ViewHelper_ContentBox::create($title, $content);

echo "
{$buildingBox}
<script type='text/javascript'>
	var \$buildingBox = $('#buildingBox');

	\$buildingBox.buildingBox();
	$('.produce').produce(
		\$buildingBox.find('.body')
	);
</script>";