<?php

abstract class ControllerAbstract implements ControllerInterface {
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
	 * @param Leviathan_Template $template
	 * @param string $path
	 */
	public function render(Leviathan_Template $template, $path) {
		// @TODO Check for online/offline page theme.
		echo $template->render("source/view/{$path}.php");
	}

	public function json(Leviathan_Template $template) {
		// @TODO Return json header and template data.
	}
}