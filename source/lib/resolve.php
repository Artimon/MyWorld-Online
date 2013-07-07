<?php

/**
 * Class Resolve
 *
 * Important:
 * Currently only useful for routes like: route/{cityId}/{position}
 */
class Resolve {
	/**
	 * @var Controller_Interface
	 */
	private $controller;

	/**
	 * @param Controller_Interface $controller
	 */
	public function __construct(Controller_Interface $controller) {
		$this->controller = $controller;
	}

	/**
	 * Note:
	 * City retrieval asserts online owner.
	 *
	 * @return City
	 */
	public function city() {
		$cityId = $this->cityId();
		$position = $this->position();

		$city = Game::getInstance()
			->account()
			->empire()
			->cities()
			->city($cityId);

		$city->assertOnlineOwner();
		$city->currentBuilding($position);

		return $city;
	}

	/**
	 * @return string
	 */
	public function key() {
		return (string)$this->controller->argument(3);
	}

	/**
	 * @return int
	 */
	public function position() {
		return (int)$this->controller->argument(2);
	}

	/**
	 * @return int
	 */
	public function cityId() {
		return (int)$this->controller->argument(1);
	}
}