<?php

/**
 * @var string $title
 * @var Resource_Interface[] $goods
 * @var int $cityId
 * @var int $position
 * @var bool $isWorking
 * @var int $remainingTime
 */

$content = '';

if ($isWorking) {
	// @TODO Translate when doing layout.
	$duration = Leviathan_Format::duration($remainingTime);
	$content .= "<p>Remaining: {$duration}</p>";
}

foreach ($goods as $resource) {
	$url = Router::build(array(
		'resource_produce',
		$cityId,
		$position,
		$resource->key()
	));

	$disabled = $isWorking ? ' disabled' : '';

	$content .= "{$resource->name()} <a href='{$url}' class='produce button{$disabled}'>{$resource->productionTypeName()}</a><br>";
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