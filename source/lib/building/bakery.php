<?php

class Building_Bakery extends Building_Abstract {
	const KEY = 'bakery';

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
			new Resource_Bread()
		);
	}
}