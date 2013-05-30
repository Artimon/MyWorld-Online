<?php

class Building_Council extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_COUNCIL;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Money(),
			new Resource_Wood(),
			new Resource_Boards()
		);
	}
}