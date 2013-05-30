<?php

interface Building_Interface {
	/**
	 * @return string
	 */
	public function key();

	/**
	 * @param int|null $level
	 * @return int
	 */
	public function level($level = null);

	/**
	 * @return Resource_Interface[]
	 */
	public function goods();
}