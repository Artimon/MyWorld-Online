<?php

interface Building_Interface {
	/**
	 * @return string
	 */
	public function key();

	/**
	 * @return string
	 */
	public function name();

	/**
	 * @param int|null $level
	 * @return int
	 */
	public function level($level = null);

	/**
	 * @param string $key
	 * @return bool
	 */
	public function is($key);

	/**
	 * @return Resource_Interface[]
	 */
	public function goods();

	/**
	 * @return bool
	 */
	public function valid();
}