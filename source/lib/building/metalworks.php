<?php

class Building_Metalworks extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Tools()
		);
	}
}