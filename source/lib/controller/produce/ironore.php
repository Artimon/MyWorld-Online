<?php

class Controller_Produce_IronOre extends Controller_Produce_Abstract {
	/**
	 * @return Resource_Interface
	 */
	protected function resource() {
		return new Resource_IronOre();
	}

	public function pageData() {
		return array();
	}
}