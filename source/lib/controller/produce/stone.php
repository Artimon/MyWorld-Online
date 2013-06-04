<?php

class Controller_Produce_Stone extends Controller_Produce_Abstract {
	/**
	 * @return Resource_Interface
	 */
	protected function resource() {
		return new Resource_Stone();
	}

	public function pageData() {
		return array();
	}
}