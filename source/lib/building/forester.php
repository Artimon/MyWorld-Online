<?php

class Building_Forester extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_FORESTER;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}
}