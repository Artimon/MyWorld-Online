<?php

class Building_Barracks extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_BARRACKS;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}
}