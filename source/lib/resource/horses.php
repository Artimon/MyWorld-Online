<?php

class Resource_Horses extends Resource_Abstract {
	const KEY = 'horses';

	/**
	 * @return string
	 */
	public function key() {
		return self::KEY;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Grain(),
			new Resource_Water()
		);
	}

	/**
	 * @return int
	 */
	public function productionAmount() {
		return 1;
	}

	/**
	 * @return int
	 */
	public function productionDuration() {
		return 3600;
	}
}