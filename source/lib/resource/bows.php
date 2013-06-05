<?php

class Resource_Bows extends Resource_Abstract {
	const KEY = 'bows';

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
			new Resource_IronIngot(),
			new Resource_Wood()
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