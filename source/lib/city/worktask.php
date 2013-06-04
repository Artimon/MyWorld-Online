<?php

class City_WorkTask extends Lisbeth_Entity {
	protected $table = 'cityWorkTasks';

	/**
	 * This should not be static due to non-static return values.
	 *
	 * @param City $city
	 * @param Building_Interface $building
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public static function create(
		City $city,
		Building_Interface $building,
		Resource_Interface $resource
	) {
		if (!$city->buildings()->has($building)) {
			return false;
		}

		if (!$building->produces($resource)) {
			return false;
		}

		$database = new Lisbeth_Database();

		$cityId		= (int)$city->id();
		$position	= (int)$building->position();
		$task		= $database->escape("produce:{$resource->key()}");
		$completion	= (int)(TIME + $resource->createDuration());
		$amount		= (int)$resource->createAmount();

		$sql = "
			INSERT INTO `cityWorkTasks`
			SET
				`cityId`		= {$cityId},
				`position`		= {$position},
				`task`			= '{$task}',
				`completion`	= {$completion},
				`amount`		= {$amount};";

		$workTasks = $city->workTasks();
		$database->query($sql)->addTo($workTasks)->freeResult();

		return $database->hasError();
	}
}