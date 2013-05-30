<?php

class Building_Farm extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_FARM;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Grain()
		);
	}
}