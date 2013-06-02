<?php

abstract class Building_Abstract implements Building_Interface {
	/**
	 * @var int
	 */
	private $level = 0;

	/**
	 * @return string
	 */
	public function name() {
		return Theme::getInstance()->resolve(
			$this->key()
		);
	}

	/**
	 * @param int|null $level
	 * @return int|null
	 */
	public function level($level = null) {
		if ($level === null) {
			return $this->level;
		}

		$this->level = (int)$level;

		return null;
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function is($key) {
		return ($key === $this->key());
	}

	/**
	 * @return bool
	 */
	public function valid() {
		return true;
	}
}