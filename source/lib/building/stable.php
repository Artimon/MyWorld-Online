<?php

class Building_Stable extends Building_Abstract {
	const KEY = 'stable';

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
			new Resource_Horses()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Boards(50),
			new Resource_Bricks(20),
			new Resource_Tools(20)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 2;
	}
}