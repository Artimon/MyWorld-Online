<?php

interface Controller_Interface {
	public function index();

	/**
	 * @return Leviathan_Request
	 */
	public function request();

	/**
	 * @param int $number
	 * @return null|string
	 */
	public function argument($number);

	/**
	 * @param string $url
	 * @throws ShutdownException
	 */
	public function redirect($url);

	/**
	 * @param Leviathan_Template $template
	 * @param string $path
	 */
	public function render(Leviathan_Template $template, $path);

	public function json(Leviathan_Template $template);
}