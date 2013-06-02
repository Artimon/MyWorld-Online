<?php

class Building_Brewery extends Building_Abstract {
	const KEY = 'brewery';

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
			new Resource_Beer()
		);
	}
}