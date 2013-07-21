<?php

class Resource_CopperOre extends Resource_Abstract {
	const KEY = 'copperOre';

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
			new Resource_Bread(3)
		);
	}

	/**
	 * @return int
	 */
	public function requiredBuildingLevel() {
		return 1;
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
		return 720;
	}
}