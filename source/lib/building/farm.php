<?php

class Building_Farm extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Grain()
		);
	}
}