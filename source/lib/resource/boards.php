<?php

class Resource_Boards extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'boards';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function requires() {
		return array(
			new Resource_Wood()
		);
	}
}