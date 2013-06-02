<?php

class Controller_Building_Mine extends Controller_Abstract {
	public function index() {
		$cityId = (int)$this->argument(1);
		$position = $this->argument(2);

		$city = Game::getInstance()
			->account()
			->empire()
			->cities()
			->city($cityId);

		$building = new Building_Mine();

		$template = new Leviathan_Template();
		$template->assignArray(array(
			'title' => $building->name(),
			'goods' => $building->goods()
		));

		$this->partial($template, 'buildingProducer');
	}

	/**
	 * @return array
	 */
	public function pageData() {
		$buildingName = Theme::getInstance()->resolve(
			$this->argument(1)
		);

		return array(
			'title' => $buildingName,
			'template' => 'pageOffline'
		);
	}
}