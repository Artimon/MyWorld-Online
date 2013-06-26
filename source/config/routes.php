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
	'building_build' => array(
		// building_create/{cityId}/{position}
		'controller' => 'Controller_Building_Build'
	),
	'building_enter' => array(
		// building_enter/{cityId}/{position}
		'controller' => 'Controller_Building_Enter'
	),
	'building_collect' => array(
		'controller' => 'Controller_Building_Collect'
	),
	'resource_produce' => array(
		'controller' => 'Controller_Resource_Produce'
	),
	'ui' => array(
		'controller' => 'Controller_UserInterface'
	),
	'pageNotFound' => array(
		'controller' => 'Controller_PageNotFound'
	)
);