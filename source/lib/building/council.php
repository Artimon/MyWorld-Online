<?php

class Building_Council extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Money(),
			new Resource_Wood(),
			new Resource_Boards()
		);
	}
}