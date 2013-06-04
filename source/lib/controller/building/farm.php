<?php

class Controller_Building_Farm extends Controller_Building_Producer {
	public function index() {
		$this->assertOnline();

		$template = $this->assignWorkData();
		$this->partial($template, 'buildingProducer');
	}
}