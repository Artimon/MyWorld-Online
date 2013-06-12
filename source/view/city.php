<?php

/**
 * @var City $city
 * @var Building_Interface[] $buildings
 */

JavaScript::getInstance()->bind("$('#city').cityViewModel({$city->id()});");

$html = '<h2>Hellooo beautiful!</h2>';
$buildingsHtml = '';
foreach ($buildings as $building) {
	$buildingsHtml .= ViewHelper_Building::create($building);
}

echo "
<div id='city'>
	{$buildingsHtml}
	<div id='buildingBox' class='null'></div>
</div>";