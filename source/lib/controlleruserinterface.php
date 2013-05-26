<?php

class ControllerUserInterface extends ControllerAbstract {
	public function index() {
		$template = new Leviathan_Template();

		$this->render($template, 'userInterface');
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		return array(
			'title' => 'MyWorld-Online - User Interface Demo',
			'template' => 'pageOnline'
		);
	}
}