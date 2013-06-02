<?php

class Building_Stable extends Building_Abstract {
	const KEY = 'stable';

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
			new Resource_Horses()
		);
	}
}