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
	 * @return int
	 */
	public function maximumNumber() {
		return 4;
	}
}