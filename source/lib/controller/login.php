<?php

class Controller_Login extends Controller_Abstract {
	public function index() {
		$this->assertOffline();

		$request = Leviathan_Request::getInstance();
		if ($request->post('login')) {
			$name = (string)$request->post('name', '');
			$password = (string)$request->post('password', '');

			Leviathan_Session::getInstance()->store('userId', 1);

			$url = Router::build(array('city'));
			$this->redirect($url);
		}

		JavaScript::getInstance()
			->bind("$('.moreGames').moreGames();")
			->bind("$('.login').loginBox();");

		$template = new Leviathan_Template();

		$this->render($template, 'login');
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		return array(
			'title' => Game::getInstance()->name() . ' - Login',
			'template' => 'pageOffline'
		);
	}
}