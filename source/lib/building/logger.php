<?php

class Building_Logger extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Wood()
		);
	}
}