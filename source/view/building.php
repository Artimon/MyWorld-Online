<?php

/**
 * @var string $buildingKey
 * @var string $title
 * @var Resource_Interface[] $goods
 * @var City $city
 * @var int $position
 * @var bool $isWorking
 * @var int $remainingTime
 * @var string $productionResourceKey
 */

$content = "<p>Description...</p>";

$js = '';
$productionList = '';
foreach ($goods as $resource) {
	$url = Router::build(array(
		'resource_produce',
		$city->id(),
		$position,
		$resource->key()
	));

	$disabled = $isWorking ? ' disabled' : '';

	$resourceKey = $resource->key();
	$tickerClass = 'ticker_' . $resourceKey;
	if ($resourceKey === $productionResourceKey) {
		$js = "$('.{$tickerClass}').ticker({$remainingTime});";

		$duration = $remainingTime;
	}
	else {
		$duration = $resource->productionDuration();
	}
	$ticker = Leviathan_Format::duration($duration);

	$requireHtml = array();
	$requires = $resource->requires();
	foreach ($requires as $requireResource) {
		$requireResourceKey = $requireResource->key();

		$requireHtml[] = "
			<div>
				<span class='resource_{$requireResourceKey}'>{$city->value($requireResourceKey)}</span> /
				{$requireResource->amountRequired()}
				{$requireResource->name()}
			</div>";
	}

	$requireHtml = empty($requireHtml)
		? '-'
		: implode(' ', $requireHtml);


	$productionList .= "
		<tr>
			<td>{$resource->name()}</td>
			<td>
				<span class='{$tickerClass}'>{$ticker}</span>
			</td>
			<td>{$requireHtml}</td>
			<td>
				<a href='{$url}' class='produce button{$disabled}'
					data-duration='{$duration}'
					data-reference='.{$tickerClass}'>
					{$resource->productionTypeName()}
				</a>
			</td>
		</tr>";
}

$content .= "<table>{$productionList}</table>";

$buildingBox = ViewHelper_ContentBox::create($title, $content);

echo "
{$buildingBox}
<script type='text/javascript'>
	$('.produce').produce();

	{$js}
</script>";