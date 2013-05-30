<?php

class Building_Stable extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Horses()
		);
	}
}