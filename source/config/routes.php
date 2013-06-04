<?php

return array(
	'login' => array(
		'controller' => 'Controller_Login'
	),
	'logout' => array(
		'controller' => 'Controller_Logout'
	),
	'city' => array(
		'controller' => 'Controller_City'
	),
	'building_mine' => array(
		// cityId/position
		'controller' => 'Controller_Building_Mine'
	),
	'building_farm' => array(
		// cityId/position
		'controller' => 'Controller_Building_Farm'
	),
	'produce_ironOre' => array(
		'controller' => 'Controller_Produce_IronOre'
	),
	'produce_coal' => array(
		'controller' => 'Controller_Produce_Coal'
	),
	'produce_stone' => array(
		'controller' => 'Controller_Produce_Stone'
	),
	'produce_goldOre' => array(
		'controller' => 'Controller_Produce_GoldOre'
	),
	'produce_grain' => array(
		'controller' => 'Controller_Produce_Grain'
	),
	'ui' => array(
		'controller' => 'Controller_UserInterface'
	),
	'pageNotFound' => array(
		'controller' => 'Controller_PageNotFound'
	)
);