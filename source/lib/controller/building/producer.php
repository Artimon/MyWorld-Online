<?php

class Controller_Building_Producer extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$template = $this->assignWorkData();
		$this->partial($template, 'buildingProducer');
	}

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
		$workTask = $cityWorkTasks->workTask($building);
		if ($workTask) {
			$isWorking = true;
			$remainingTime = $workTask->remainingTime();
		}
		else {
			$isWorking = false;
			$remainingTime = 0;
		}

		$template->assignArray(array(
			'title' => $building->name(),
			'goods' => $building->goods(),
			'position' => $building->position(),
			'cityId' => $city->id(),
			'isWorking' => $isWorking,
			'remainingTime' => $remainingTime
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