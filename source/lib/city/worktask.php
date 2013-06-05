<?php

class City_WorkTask extends Lisbeth_Entity {
	protected $table = 'cityWorkTasks';

	/**
	 * @return int
	 */
	public function completion() {
		return (int)$this->value('completion');
	}

	/**
	 * @return int
	 */
	public function remainingTime() {
		return ($this->completion() - TIME);
	}

	/**
	 * @return bool
	 */
	public function isCompleted() {
		return (TIME >= $this->completion());
	}

	public function convert(City $city, City_WorkTasks $workTasks) {
		if (!$this->isCompleted()) {
			return false;
		}

		$parts = explode(':', $this->value('task'));
		switch ($parts[0]) {
			case 'produce':
				$resourceKey = $parts[1];
				$resource = Resource::get($resourceKey);
				$city->increment(
					$resourceKey,
					$resource->productionAmount()
				);
				break;

			default:
				break;
		}

		$workTasks->removeEntity($this->id());
		$this->delete();

		return true;
	}

	/**
	 * This should not be static due to non-static return values.
	 *
	 * @param City $city
	 * @param Building_Interface $building
	 * @param string $task
	 * @param int $completion
	 * @param int $amount
	 * @return bool
	 */
	public static function insert(
		City $city,
		Building_Interface $building,
		$task,
		$completion,
		$amount
	) {
		$database = new Lisbeth_Database();

		$cityId		= (int)$city->id();
		$position	= (int)$building->position();
		$task		= $database->escape($task);
		$completion	= (int)$completion;
		$amount		= (int)$amount;

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