<?php

class Building_Well extends Building_Abstract {
	const KEY = 'well';

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
			new Resource_Water()
		);
	}
}