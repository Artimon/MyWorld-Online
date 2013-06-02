<?php

class Resource_Horses extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'horses';
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