<?php

class Building_Smelter extends Building_Abstract {
	const KEY = 'smelter';

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
			new Resource_IronIngot(),
			new Resource_GoldIngot()
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 3;
	}
}