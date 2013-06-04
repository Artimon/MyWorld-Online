<?php

class Resource_IronIngot extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'ironIngot';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_IronOre(),
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