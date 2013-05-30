<?php

class Resource_Money extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'money';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array();
	}
}