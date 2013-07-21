<?php

class Controller_Building_Buildable extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$resolve = new Resolve($this);
		$position = $resolve->position();

		$city = $resolve->city();
		$buildable = Buildings::__toArray(
			$city->buildingsBuildable($position),
			$city
		);

		$template = new Leviathan_Template();
		$template->assignArray($buildable);

		$this->json($template);
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}