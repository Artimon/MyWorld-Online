<?php

class Building_Barracks extends Building_Abstract {
	const KEY = 'barracks';

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
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}