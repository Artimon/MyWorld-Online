<?php

class Building_Brickworks extends Building_Abstract {
	const KEY = 'brickworks';

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
			new Resource_Bricks()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Boards(10),
			new Resource_Bricks(15),
			new Resource_Tools(10)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 2;
	}
}