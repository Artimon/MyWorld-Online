<?php

class Building_Warehouse extends Building_Abstract {
	const KEY = 'warehouse';

	/**
	 * @return string
	 */
	public function key() {
		return self::KEY;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Boards(20),
			new Resource_Bricks(20)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 4;
	}
}