<?php

class Resource_Beer extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'beer';
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