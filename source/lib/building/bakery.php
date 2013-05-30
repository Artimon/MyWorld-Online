<?php

class Building_Bakery extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_BAKERY;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Bread()
		);
	}
}