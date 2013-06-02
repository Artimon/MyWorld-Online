<?php

class Building_Metalworks extends Building_Abstract {
	const KEY = 'metalworks';

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
			new Resource_Tools()
		);
	}
}