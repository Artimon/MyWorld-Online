<?php

class Resource_Tools extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'tools';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_IronIngot(),
			new Resource_Wood()
		);
	}
}