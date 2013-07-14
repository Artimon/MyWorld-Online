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
	protected function requiresBuild() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade1() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade2() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade3() {
		return array();
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 1;
	}
}