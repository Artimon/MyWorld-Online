<?php

class Controller_Building_Enter extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$resolve = new Resolve($this);

		$city = $resolve->city();
		$position = $resolve->position();
		$building = $city->currentBuilding();

		if ($building && $building->valid()) {
			$file = 'building';
			$template = $this->assignWorkData($city, $building);
		}
		else {
			$file = 'buildList';
			$template = $this->assignBuildData($city, $position);
		}

		$this->partial($template, $file);
	}

	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @return Leviathan_Template
	 */
	protected function assignWorkData(City $city, Building_Interface $building) {
		$workTasks = $city->workTasks();

		$isWorking = $workTasks->isWorking($building);
		if ($isWorking) {
			$workTask = $workTasks->workTask($building);
			$remainingTime = $workTask->remainingTime();
			$resourceKey = $workTask->resource()->key();
		}
		else {
			$remainingTime = 0;
			$resourceKey = '';
		}

		$template = new Leviathan_Template();
		$template->assignArray(array(
			'buildingKey' => $building->key(),
			'title' => $building->name(),
			'goods' => $building->goods(),
			'position' => $building->position(),
			'city' => $city,
			'isWorking' => $isWorking,
			'remainingTime' => $remainingTime,
			'productionResourceKey' => $resourceKey
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
			'city' => $city,
			'position' => $position,
			'buildings' => $city->buildingsBuildable()
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