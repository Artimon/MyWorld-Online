<?php

class City_WorkTasks extends Lisbeth_Collection {
	protected $table = 'cityWorkTasks';
	protected $group = 'cityId';
	protected $order = 'id DESC';
	protected $entityName = 'City_WorkTask';

	/**
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function isWorking(Building_Interface $building) {
		$position = $building->position();
		foreach ($this->entities as $entity) {
			if ($position == $entity->value('position')) {
				return true;
			}
		}

		return false;
	}
}