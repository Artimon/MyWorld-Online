<?php

class Building_Bakery extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Bread()
		);
	}
}