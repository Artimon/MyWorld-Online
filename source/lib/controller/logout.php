<?php

class Controller_Logout extends Controller_Abstract {
	public function index() {
		Leviathan_Session::getInstance()->reset();

		$this->redirect(
			Router::build(array('login'))
		);

		// Nothing to render after redirect.
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array(); // No data needed, since no page is rendered.
	}
}