<?php

class Building_ClayPit extends Building_Abstract {
	const KEY = 'clayPit';

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
			new Resource_Clay()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Boards(10),
			new Resource_Tools(5)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 2;
	}
}