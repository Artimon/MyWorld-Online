<?php

class Resource_Bows extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'bows';
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