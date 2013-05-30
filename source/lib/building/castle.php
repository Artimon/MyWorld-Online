<?php

class Building_Castle extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_CASTLE;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}
}