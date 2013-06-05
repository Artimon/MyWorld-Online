<?php

class Resource_Produce {
	/**
	 * @return Resource_Produce
	 */
	public static function getInstance() {
		return new self();
	}

	public function resolved(
		Controller_Interface $controller,
		Resolve $resolve,
		Leviathan_Template $template,
		Resource_Interface $resource
	) {
		$city = $resolve->city($controller);
		$building = $city->currentBuilding();

		$cityWorkTasks = $city->workTasks();
		$isWorking = $cityWorkTasks->isWorking($building);

		$error = false;
		$message = '';
		if ($isWorking) {
			$error = true;
			$message = i18n('alreadyWorking');
		}
		else {
			$resource->produce($city, $building, $resource);
		}

		return $template->assignArray(array(
			'error' => $error,
			'message' => $message
		));
	}
}