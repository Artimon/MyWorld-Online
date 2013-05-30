<?php

class Building_Mill extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_MILL;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}
}