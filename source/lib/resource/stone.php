<?php

class Resource_Stone extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'stone';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Bread()
		);
	}
}