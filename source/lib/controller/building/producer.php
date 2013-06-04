<?php

abstract class Controller_Building_Producer extends Controller_Abstract {
	/**
	 * @return Leviathan_Template
	 * @throws InvalidArgumentException
	 */
	protected function assignWorkData() {
		$resolve = new Resolve();

		$city = $resolve->city($this);
		$cityWorkTasks = $city->workTasks();
		$building = $city->currentBuilding();

		$template = new Leviathan_Template();
		$template->assignArray(array(
			'title' => $building->name(),
			'goods' => $building->goods(),
			'position' => $building->position(),
			'cityId' => $city->id(),
			'isWorking' => $cityWorkTasks->isWorking($building),
			'workTask' => null
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