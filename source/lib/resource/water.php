<?php

class Resource_Water extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'water';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array();
	}
}