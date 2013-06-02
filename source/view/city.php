<?php

/**
 * @var Building_Interface[] $buildings
 */

JavaScript::getInstance()->bind("$('.showBuilding').showBuilding();");

echo "Hellooo beautiful!";
foreach ($buildings as $building) {
	$url = Router::build(array(
		'building_' . $building->key(),
		1,
		'position1'
	));

	echo "
		<p>
			{$building->name()} ({$building->level()}) -
			<a href='{$url}' class='showBuilding'>click</a>
		</p>";
}
echo "<div id='buildingBox' class='null'></div>";