<?php

class Building_Brewery extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Beer()
		);
	}
}