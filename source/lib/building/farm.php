<?php

class Building_Farm extends Building_Abstract {
	const KEY = 'farm';

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
			new Resource_Grain()
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 5;
	}
}