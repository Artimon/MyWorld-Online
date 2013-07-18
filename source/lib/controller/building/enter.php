<?php

class Controller_Building_Enter extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$resolve = new Resolve($this);
		$position = $resolve->position();

		$city = $resolve->city();
		$building = $city->currentBuilding();

		$template = ($building && $building->valid())
			? $this->assignWorkData($city, $building)
			: $this->assignBuildData($city, $position);

		$this->json($template);
	}

	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @return Leviathan_Template
	 */
	protected function assignWorkData(City $city, Building_Interface $building) {
		$template = new Leviathan_Template();
		$template->assignArray(array(
			'isConstructionSite' => false,
			'title' => $building->name(),
			'goods' => $building->goodsArray($city, true),
			'buildable' => array()
		));

		return $template;
	}

	/**
	 * @param City $city
	 * @param int $position
	 * @return Leviathan_Template
	 */
	protected function assignBuildData(City $city, $position) {
		$template = new Leviathan_Template();
		$template->assignArray(array(
			'isConstructionSite' => true,
			'title' => 'emptyConstructionSite',
			'goods' => array(),
			'buildable' => Buildings::__toArray(
				$city->buildingsBuildable($position),
				$city
			)
		));

		return $template;
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}