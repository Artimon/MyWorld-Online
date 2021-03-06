<?php

/**
 * Class Building_Null
 *
 * Null object pattern for empty building places or undefined buildings.
 */
class Building_Null extends Building_Abstract {
	const KEY = '';

	/**
	 * @return string
	 */
	public function key() {
		return self::KEY;
	}

	/**
	 * @return Resource_Interface[]
	 */
	public function goods() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresBuild() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade1() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade2() {
		return array();
	}

	/**
	 * @return Resource_Interface[]
	 */
	protected function requiresUpgrade3() {
		return array();
	}

	/**
	 * @return bool
	 */
	public function valid() {
		return false;
	}

	/**
	 * @return int
	 */
	public function maximumNumber() {
		return 0;
	}
}