<?php

class Building_Mine extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return Buildings::BUILDING_MINE;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_IronOre(),
			new Resource_Coal(),
			new Resource_Stone(),
			new Resource_GoldOre()
		);
	}
}