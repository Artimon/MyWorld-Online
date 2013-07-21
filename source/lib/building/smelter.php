<?php

class Building_Smelter extends Building_Abstract {
	const KEY = 'smelter';

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
			new Resource_BronzeIngot(),
			new Resource_IronIngot()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresBuild() {
		return array(
			new Resource_Boards(15),
			new Resource_Bricks(15)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade1() {
		return array(
			new Resource_Boards(35),
			new Resource_Bricks(30)
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
		return 3;
	}
}