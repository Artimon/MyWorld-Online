<?php

abstract class Controller_Abstract implements Controller_Interface {
	/**
	 * @var array
	 */
	protected $params;

	/**
	 * @param array $params
	 */
	public function __construct(array $params) {
		$this->params = $params;
	}

	/**
	 * @return array ['title', 'template']
	 */
	abstract protected function pageData();

	/**
	 * @param string $url
	 * @throws ShutdownException
	 */
	public function redirect($url) {
		$url = html_entity_decode($url);
		header('location: ' . $url);

		throw new ShutdownException();
	}

	protected function assertOnline() {
		if (!Game::getInstance()->isOnline()) {
			$url = Router::build(array('login'));
			$this->redirect($url);
		}
	}

	protected function assertOffline() {
		if (Game::getInstance()->isOnline()) {
			$url = Router::build(array('city'));
			$this->redirect($url);
		}
	}

	/**
	 * @param Leviathan_Template $template
	 * @param string $path
	 */
	public function render(Leviathan_Template $template, $path) {
		$data = $this->pageData();

		$page = new Leviathan_Template();
		$page->assignArray(array(
			'pageTitle' => $data['title'],
			'body' => $template->render("source/view/{$path}.php")
		));

		// @TODO Check for online/offline page theme, or move to implementation.
		echo $page->render("source/view/{$data['template']}.php");
	}

	public function json(Leviathan_Template $template) {
		// @TODO Return json header and template data.
	}
}