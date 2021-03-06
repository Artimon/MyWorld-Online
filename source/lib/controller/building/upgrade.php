<?php

class Controller_Building_Upgrade extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$template = new Leviathan_Template();

		$resolve = new Resolve($this);
		$position = $resolve->position();

		$city = $resolve->city();

		$success = $city->buildingUpgrade($position);
		if ($success) {
			$template->assignArray(array(
				'error' => false,
				'message' => 'buildingUpgradeStarted',
				'resources' => $city->resourcesArray(),
				'building' => $city->building($position)->__toArray($city)
			));
		}
		else {
			$template->assignArray(array(
				'error' => true,
				'message' => 'buildingUpgradeFailed'
			));
		}

		$this->json($template);
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}