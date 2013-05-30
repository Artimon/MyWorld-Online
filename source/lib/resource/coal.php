<?php

class Resource_Coal extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'coal';
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