<?php

class Controller_Building_Build extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$template = new Leviathan_Template();

		$resolve = new Resolve($this);
		$position = $resolve->position();
		$buildingKey = $resolve->key();

		$city = $resolve->city();

		$success = $city->buildingBuild($buildingKey, $position);
		if ($success) {
			$template->assignArray(array(
				'error' => false,
				'message' => 'buildingBuildStarted',
				'resources' => $city->resourcesArray(),
				'building' => $city->building($position)->__toArray($city)
			));
		}
		else {
			$template->assignArray(array(
				'error' => true,
				'message' => 'buildingBuildFailed'
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