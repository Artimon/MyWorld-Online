<?php

class Controller_Building_Mine extends Controller_Building_Producer {
	public function index() {
		$this->assertOnline();

		$template = $this->assignWorkData();
		$this->partial($template, 'buildingProducer');
	}
}