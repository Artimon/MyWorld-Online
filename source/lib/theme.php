<?php

class Theme {
	/**
	 * @var Theme
	 */
	private static $instance;

	/**
	 * @return Theme
	 */
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @TODO Add implementation.
	 *
	 * @param string $key
	 * @return string
	 */
	public function resolve($key) {
		return $key;
	}
}