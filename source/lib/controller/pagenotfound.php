<?php

class Controller_PageNotFound extends Controller_Abstract {
	public function index() {
		$this->render(
			new Leviathan_Template(),
			'pageNotFound'
		);
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		$template = Game::getInstance()->isOnline()
			? 'pageOnline'
			: 'pageOffline';

		return array(
			'title' => i18n('pageNotFound'),
			'template' => $template
		);
	}
}