<?php

class Resource_Tools extends Resource_Abstract {
	const KEY = 'tools';

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