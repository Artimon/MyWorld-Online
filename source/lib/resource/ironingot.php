<?php

class Resource_IronIngot extends Resource_Abstract {
	const KEY = 'ironIngot';

	/**
	 * @return string
	 */
	public function key() {
		return self::KEY;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_IronOre(2),
			new Resource_Coal(8)
		);
	}

	/**
	 * @return int
	 */
	public function productionAmount() {
		return 4;
	}

	/**
	 * @return int
	 */
	public function productionDuration() {
		return 720;
	}
}