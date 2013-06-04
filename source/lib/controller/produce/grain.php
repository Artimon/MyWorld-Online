<?php

class Controller_Produce_Grain extends Controller_Produce_Abstract {
	/**
	 * @return Resource_Interface
	 */
	protected function resource() {
		return new Resource_Grain();
	}

	public function pageData() {
		return array();
	}
}