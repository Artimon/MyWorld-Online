<?php

class Controller_Building extends Controller_Abstract {
	public function index() {
		$this->assertOnline();

		$resolve = new Resolve($this);
		$position = $resolve->position();

		$city = $resolve->city();
		$city->workTasks()->convertUpgradeTasks($city);
		$city->assignWorkTasks();

		$template = new Leviathan_Template();
		$template->assignArray(
			$city->building($position)->__toArray($city)
		);

		$this->json($template);
	}

	/**
	 * @return array
	 */
	public function pageData() {
		return array();
	}
}