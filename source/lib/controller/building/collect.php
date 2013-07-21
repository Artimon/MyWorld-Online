<?php

class Controller_Building_Collect extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$resolve = new Resolve($this);
		$city = $resolve->city();

		$building = $city->building(
			$resolve->position()
		);

		$success = false;
		$workTask = $building->workTask();
		if ($workTask) {
			$success = $workTask->convert(
				$city,
				$city->workTasks()
			);
		}

		$template = new Leviathan_Template();
		$template->assignArray(array(
			'success' => $success,
			'resources' => $city->resourcesArray($building, true),
			'building' => $building->__toArray($city)
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