<?php

class Resource_Grain extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'grain';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array();
	}
}