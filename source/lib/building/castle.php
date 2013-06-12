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
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}