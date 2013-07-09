<?php

class Controller_Building_Build extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$this->json(
			$this->assignBuildData()
		);
	}

	/**
	 * @return Leviathan_Template
	 */
	protected function assignBuildData() {
		$template = new Leviathan_Template();

		$resolve = new Resolve($this);
		$position = $resolve->position();
		$buildingKey = $resolve->key();

		$city = $resolve->city();
		$building = $city->currentBuilding();

		if (!$city->isConstructionSite($position)) {
			return $template->assignArray(array(
				'error' => true,
				'message' => '@TODO Translate: construction site not available.'
			));
		}

		$hasResources = $city->hasResources(
			$building->requires()
		);

		if (!$hasResources) {
			return $template->assignArray(array(
				'error' => true,
				'message' => '@TODO Translate: missing resources.'
			));
		}

		$city->buildingBuild($buildingKey, $position);
		$city->assignWorkTasks();

		return $template->assignArray(array(
			'error' => false,
			'message' => '@TODO Translate: construction started.',
			'resources' => $city->resourcesArray(),
			'buildings' => $city->buildingsArray()
		));
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}