<?php

class Resource_Wood extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'wood';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array();
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