<?php

class Resolve {
	/**
	 * @param Controller_Interface $controller
	 * @return City
	 */
	public function city(Controller_Interface $controller) {
		$cityId = (int)$controller->argument(1);
		$position = $controller->argument(2);

		$city = Game::getInstance()
			->account()
			->empire()
			->cities()
			->city($cityId);

		$city->assertOnlineOwner();
		$city->currentBuilding($position);

		return $city;
	}
}