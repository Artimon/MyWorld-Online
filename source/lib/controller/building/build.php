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
		$city = $resolve->city();
		$building = $city->currentBuilding();

		if (!$building->isConstructionSite()) {
			return $template->assignArray(array(
				'error' => true,
				'message' => '@TODO Translate construction site not available.'
			));
		}

		$hasResources = $city->hasResources(
			$building->requires()
		);

		if (!$hasResources) {
			return $template->assignArray(array(
				'error' => true,
				'message' => '@TODO Translate missing resources.'
			));
		}

		$city->buildingBuild();

		return $template->assignArray(array(
			'error' => false,
			'message' => '@TODO Translate construction started.'
		));
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}