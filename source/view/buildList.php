<?php

/**
 * @var City $city
 * @var int $position
 * @var Building_Interface[] $buildings
 */

$viewHelper = ViewHelper_Resources::create()->setSource($city);

$buildingList = '';
foreach ($buildings as $building) {
	$viewHelper->setResources($building->requires());

	$url = Router::build(array(
		'building_build',
		$city->id(),
		$position,
		$building->key()
	));

	$buildingList .= "
		<tr>
			<td>{$building->name()}</td>
			<td>{$viewHelper->get()}</td>
			<td>
				<a href='{$url}' class='produce button'>
					{$building->buildTypeName()}
				</a>
			</td>
		</tr>";
}

$content = "<table>{$buildingList}</table>";

echo $buildingBox = ViewHelper_ContentBox::create('Build', $content);