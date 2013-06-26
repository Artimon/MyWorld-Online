<?php

class Building_Metalworks extends Building_Abstract {
	const KEY = 'metalworks';

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
		return array(
			new Resource_Tools()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Boards(20),
			new Resource_Bricks(15),
			new Resource_Tools(10)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 3;
	}
}