<?php

class ControllerPageNotFound extends ControllerAbstract {
	public function index() {
		$this->render(
			new Leviathan_Template(),
			'pageNotFound'
		);
	}
}