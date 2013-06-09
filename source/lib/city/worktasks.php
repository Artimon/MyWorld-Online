<?php

class City_WorkTasks extends Lisbeth_Collection {
	protected $table = 'cityWorkTasks';
	protected $group = 'cityId';
	protected $order = 'id DESC';
	protected $entityName = 'City_WorkTask';

	/**
	 * @var City
	 */
	private $city;

	/**
	 * @param City $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @param Building_Interface $building
	 * @return City_WorkTask|null
	 */
	public function workTask(Building_Interface $building) {
		$position = $building->position();

		foreach ($this->entities as $entity) {
			if ($position == $entity->value('position')) {
				return $entity;
			}
		}

		return null;
	}

	/**
	 * Working buildings can be checked from both sides.
	 * 1. Pass a building to determine whether or not there is a task.
	 * 2. Ask work tasks for positions to equal building positions.
	 *
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function isWorking(Building_Interface $building) {
		return ($this->workTask($building) !== null);
	}
}