<?php

class Resource_Swords extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'swords';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_IronIngot(),
			new Resource_Coal()
		);
	}
}