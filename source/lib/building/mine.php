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
			new Resource_IronOre(),
			new Resource_GoldOre()
		);
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Boards(10),
			new Resource_Bricks(15)
		);
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 5;
	}
}