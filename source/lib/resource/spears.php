<?php

class Resource_Spears extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'spears';
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