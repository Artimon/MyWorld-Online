<?php

class Building_Logger extends Building_Abstract {
	const KEY = 'logger';

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
			new Resource_Wood()
		);
	}
}