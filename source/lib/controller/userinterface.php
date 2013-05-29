<?php

class Controller_UserInterface extends Controller_Abstract {
	public function index() {
		$template = new Leviathan_Template();

		$this->render($template, 'userInterface');
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		return array(
			'title' => Game::getInstance()->name() . ' - User Interface Demo',
			'template' => 'pageOnline'
		);
	}
}