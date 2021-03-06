<?php

class Building_Mine extends Building_Abstract {
	const KEY = 'mine';

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
			new Resource_Coal(),
			new Resource_CopperOre(),
			new Resource_IronOre()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresBuild() {
		return array(
			new Resource_Boards(10),
			new Resource_Bricks(15)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade1() {
		return array(
			new Resource_Tools(15)
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade2() {
		return array(
			new Resource_Tools(40)
		);
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