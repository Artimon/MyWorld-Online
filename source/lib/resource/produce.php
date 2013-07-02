<?php

class Resource_Produce {
	/**
	 * @return Resource_Produce
	 */
	public static function getInstance() {
		return new self();
	}

	/**
	 * @param Resolve $resolve
	 * @param Leviathan_Template $template
	 * @param Resource_Interface $resource
	 * @return Leviathan_Template
	 */
	public function resolved(
		Resolve $resolve,
		Leviathan_Template $template,
		Resource_Interface $resource
	) {
		$city = $resolve->city();
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
			'message' => $message,
			'resources' => $city->resourcesArray($building, true)
		));
	}
}