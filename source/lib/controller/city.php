<?php

class Controller_City extends Controller_Abstract {
	public function index() {
		$city = new City(1);
		$template = new Leviathan_Template();
		$template->assignValue('buildings', $city->tempList());

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