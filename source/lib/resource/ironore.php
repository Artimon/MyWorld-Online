<?php

class Resource_IronOre extends Resource_Abstract {
	const KEY = 'ironOre';

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
			new Resource_Bread(2)
		);
	}

	/**
	 * @return int
	 */
	public function requiredBuildingLevel() {
		return 4;
	}

	/**
	 * @return int
	 */
	public function productionAmount() {
		return 1;
	}

	/**
	 * @return int
	 */
	public function productionDuration() {
		return 360;
	}
}