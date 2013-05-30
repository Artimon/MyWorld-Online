<?php

class Building_TaxCollector extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_TAX_COLLECTOR;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}
}