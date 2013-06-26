<?php

class Controller_Resource_Produce extends Controller_Abstract {
	public function index() {
		$template = Resource_Produce::getInstance()->resolved(
			new Resolve($this),
			new Leviathan_Template(),
			Resource::get($this->argument(3))
		);

		$this->json($template);
	}

	public function pageData() {
		return array();
	}
}