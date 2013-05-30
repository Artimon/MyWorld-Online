<?php

class Resource_GoldOre extends Resource_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return 'goldOre';
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