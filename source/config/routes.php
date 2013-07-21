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
	'building_buildable' => array(
		'controller' => 'Controller_Building_Buildable'
	),
	'building_build' => array(
		// building_build/{cityId}/{position}/building_key
		'controller' => 'Controller_Building_Build'
	),
	'building_upgrade' => array(
		// building_upgrade/{cityId}/{position}/building_key
		'controller' => 'Controller_Building_Upgrade'
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
	'page_not_found' => array(
		'controller' => 'Controller_PageNotFound'
	)
);