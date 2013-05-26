<?php

class ControllerLogin extends ControllerAbstract {
	public function index() {
		$template = new Leviathan_Template();

		$this->render($template, 'login');
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		return array(
			'title' => 'MyWorld-Online - Login',
			'template' => 'pageOffline'
		);
	}
}