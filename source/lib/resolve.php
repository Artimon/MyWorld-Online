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
	 * @var City
	 */
	private $city;

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
		if (!$this->city) {
			$cityId = $this->cityId();

			$this->city = Game::getInstance()
				->account()
				->empire()
				->cities()
				->city($cityId);

			$this->city->assertOnlineOwner();
			$this->city->assignWorkTasks();
		}

		return $this->city;
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