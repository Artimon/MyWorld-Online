<?php

abstract class ViewHelper_Abstract {
	/**
	 * @return string
	 */
	abstract public function get();

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->get();
	}
}