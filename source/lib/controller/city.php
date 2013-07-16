<?php

class Controller_City extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		/** @var City $city */
		$city = Lisbeth_ObjectPool::get('City', 1);
		$city->workTasks()->convertUpgradeTasks($city);
		$city->assignWorkTasks();

		$template = new Leviathan_Template();
		$template->assignArray(array(
			'city' => $city,
			'resources' => json_encode($city->resourcesArray()),
			'buildings' => json_encode($city->buildingsArray())
		));

		$this->render($template, 'city');
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		return array(
			'title' => Game::getInstance()->name() . ' - ', // @TODO Add user name or something the likes.
			'template' => 'pageOnline'
		);
	}
}