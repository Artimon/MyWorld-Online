<?php

class Building_Well extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_WELL;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Water()
		);
	}
}