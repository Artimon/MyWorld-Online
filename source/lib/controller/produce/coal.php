<?php

class Controller_Produce_Coal extends Controller_Produce_Abstract {
	/**
	 * @return Resource_Interface
	 */
	protected function resource() {
		return new Resource_Coal();
	}

	public function pageData() {
		return array();
	}
}