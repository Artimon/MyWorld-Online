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

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresBuild() {
		return array(
			new Resource_Tools(10)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade1() {
		return array(
			new Resource_Wood(2)
//			new Resource_Boards(30),
//			new Resource_Bricks(25)
		);
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
		return 5;
	}
}