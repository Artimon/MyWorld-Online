<?php

/**
 * @var City $city
 * @var Building_Interface[] $buildings
 */

JavaScript::getInstance()->bind("$('.showBuilding').showBuilding();");

echo "Hellooo beautiful!";
foreach ($buildings as $building) {
	if (!$building->valid()) {
		continue;
	}

	$url = Router::build(array(
		'building_' . $building->key(),
		$city->id(),
		$building->position()
	));

	echo "
		<p>
			{$building->name()} ({$building->level()}) -
			<a href='{$url}' class='showBuilding'>click</a>
		</p>";
}
echo "<div id='buildingBox' class='null'></div>";