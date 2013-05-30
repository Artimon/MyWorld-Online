<?php

class Building_Brewery extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_BREWERY;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Beer()
		);
	}
}