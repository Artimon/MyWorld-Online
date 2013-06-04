<?php

class Resource_Shields extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'shields';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_IronIngot(),
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