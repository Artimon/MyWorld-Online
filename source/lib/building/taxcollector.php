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
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}