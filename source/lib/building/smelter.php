<?php

class Building_Smelter extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_IronIngot(),
			new Resource_GoldIngot()
		);
	}
}