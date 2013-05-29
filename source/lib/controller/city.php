<?php

class Controller_City extends Controller_Abstract {
	public function index() {
		$template = new Leviathan_Template();
		$url = Router::build(array('logout'));
		$template->assignValue('logoutUrl', $url);

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