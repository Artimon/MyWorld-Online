<?php

class Controller_Building_Enter extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$template = $this->assignWorkData();
		$this->partial($template, 'building');
	}

	/**
	 * @return Leviathan_Template
	 * @throws InvalidArgumentException
	 */
	protected function assignWorkData() {
		$resolve = new Resolve();

		$city = $resolve->city($this);
		$workTasks = $city->workTasks();
		$building = $city->currentBuilding();

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
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}