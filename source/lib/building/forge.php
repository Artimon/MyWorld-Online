<?php

class Building_Forge extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_FORGE;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Swords(),
			new Resource_Shields(),
			new Resource_Spears(),
			new Resource_Bows()
		);
	}
}