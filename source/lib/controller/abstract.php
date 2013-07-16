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
	 * @return Leviathan_Request
	 */
	public function request() {
		return Leviathan_Request::getInstance();
	}

	/**
	 * @param int $number
	 * @return null|string
	 */
	public function argument($number) {
		if (array_key_exists($number, $this->params)) {
			return $this->params[$number];
		}

		return null;
	}

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

		$language = new Language();

		$page = new Leviathan_Template();
		$page->assignArray(array(
			'pageTitle' => $data['title'],
			'language' => $language->get(),
			'body' => $template->render("source/view/{$path}.php")
		));

		echo $page->render("source/view/{$data['template']}.php");
	}

	/**
	 * @param Leviathan_Template $template
	 * @param string $path
	 */
	public function partial(Leviathan_Template $template, $path) {
		echo $template->render("source/view/{$path}.php");
	}

	/**
	 * @param Leviathan_Template $template
	 */
	public function json(Leviathan_Template $template) {
		header('Content-type: application/json');

		echo $template->json();
	}
}