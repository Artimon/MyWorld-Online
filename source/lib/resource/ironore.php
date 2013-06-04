<?php

class Resource_IronOre extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'ironOre';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Bread()
		);
	}

	/**
	 * @return int
	 */
	public function createAmount() {
		return 1;
	}

	/**
	 * @return int
	 */
	public function createDuration() {
		return 3600;
	}
}