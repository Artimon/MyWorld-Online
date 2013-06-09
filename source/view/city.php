<?php

/**
 * @var City $city
 * @var Building_Interface[] $buildings
 */

JavaScript::getInstance()->bind("$('.buildingInteract').buildingInteract();");

echo "Hellooo beautiful!";
foreach ($buildings as $building) {
	if (!$building->valid()) {
		continue;
	}

	$enterUrl = Router::build(array(
		'building_producer',
		$city->id(),
		$building->position()
	));

	$collectUrl = Router::build(array(
		'building_collect',
		$city->id(),
		$building->position()
	));

	$icon = '';
	$action = 'enter';

	$workTask = $building->workTask();
	if ($workTask) {
		$isWorking = true;
		$hasFinishedWork = $workTask->isCompleted();

		if ($hasFinishedWork) {
			$action = 'collect';
		}
		else {
			$icon = "<span class='entypo-tools'></span>";
		}
	}
	else {
		$isWorking = false;
		$hasFinishedWork = false;
		$icon = "<span class='entypo-flag'></span>";
	}

	echo "
		<p class='building'>
			{$building->name()}
			({$building->level()})
			{$icon} -
			<a href='javascript:;' class='buildingInteract'
				data-enter='{$enterUrl}'
				data-collect='{$collectUrl}'
				data-action='{$action}'>
				collect/show
			</a>
		</p>";
}
echo "<div id='buildingBox' class='null'></div>";