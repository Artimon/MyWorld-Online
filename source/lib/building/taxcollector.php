<?php

class Building_TaxCollector extends Building_Abstract {
	const KEY = 'taxCollector';

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
			new Resource_Boards(50),
			new Resource_Bricks(50),
			new Resource_Tools(40)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}