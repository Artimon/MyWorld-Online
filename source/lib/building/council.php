<?php

class Building_Council extends Building_Abstract {
	const KEY = 'council';

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
//			new Resource_Money(),
			new Resource_Wood(),
			new Resource_Boards()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array();
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}