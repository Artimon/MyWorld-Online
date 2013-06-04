<?php

class Resource_GoldIngot extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'goldIngot';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_GoldOre(),
			new Resource_Coal()
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