<?php

class Resource_Bread extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'bread';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Grain(),
			new Resource_Water()
		);
	}
}