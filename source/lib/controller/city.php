<?php

class Controller_City extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$city = new City(1);
		$city->assignWorkTasks();
		$template = new Leviathan_Template();
		$template->assignArray(array(
			'city' => $city,
			'buildings' => $city->tempList()
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