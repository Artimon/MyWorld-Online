<?php

class Controller_Produce_GoldOre extends Controller_Produce_Abstract {
	/**
	 * @return Resource_Interface
	 */
	protected function resource() {
		return new Resource_GoldOre();
	}

	public function pageData() {
		return array();
	}
}