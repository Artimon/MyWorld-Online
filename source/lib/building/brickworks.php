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
	 * @return int
	 */
	public function maximumNumber() {
		return 2;
	}
}