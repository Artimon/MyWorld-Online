<?php

class Building_Sawmill extends Building_Abstract {
	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array(
			new Resource_Boards()
		);
	}
}