<?php

class Building_Farm extends Building_Abstract {
	const KEY = 'farm';

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
			new Resource_Grain()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresBuild() {
		return array(
			new Resource_Boards(20),
			new Resource_Bricks(5)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade1() {
		return array(
			new Resource_Boards(20),
			new Resource_Bricks(5)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade2() {
		return array(
			new Resource_Boards(20),
			new Resource_Bricks(5)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade3() {
		return array(
			new Resource_Boards(20),
			new Resource_Bricks(5)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 5;
	}
}