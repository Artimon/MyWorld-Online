<?php

class Building_Sawmill extends Building_Abstract {
	const KEY = 'sawmill';

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
			new Resource_Boards()
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 3;
	}
}