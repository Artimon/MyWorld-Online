<?php

abstract class Controller_Produce_Abstract extends Controller_Abstract {
	/**
	 * @return Resource_Interface
	 */
	abstract protected function resource();

	public function index() {
		$template = Resource_Produce::getInstance()->resolved(
			$this,
			new Resolve(),
			new Leviathan_Template(),
			$this->resource()
		);

		$this->json($template);
	}
}