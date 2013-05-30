<?php

class Resource_Shields extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'shields';
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