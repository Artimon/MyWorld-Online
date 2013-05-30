<?php

/**
 * Class Building_Null
 *
 * Null object pattern for empty building places or undefined buildings.
 */
class Building_Null extends Building_Abstract {
	/**
	 * @return string
	 */
	public function key() {
		return '';
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}
}