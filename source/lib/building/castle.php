<?php

class Building_Castle extends Building_Abstract {
	const KEY = 'castle';

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
			new Resource_Boards(25),
			new Resource_Bricks(50),
			new Resource_Tools(20)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}