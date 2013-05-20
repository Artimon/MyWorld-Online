<?php

class ControllerLogin extends ControllerAbstract {
	public function index() {
		$template = new Leviathan_Template();
		$template->assignValue(
			'pageTitle',
			'MyWorld - Under Construction'
		);

		$this->render($template, 'page');
	}
}