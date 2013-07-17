<?php

class Controller_Building_Upgrade extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$resolve = new Resolve($this);

		$city = $resolve->city();
		$building = $city->currentBuilding();

		$template = new Leviathan_Template();
		$template->assignArray(array(
			'error' => !$building->upgrade($city)
		));

		$this->json($template);
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}