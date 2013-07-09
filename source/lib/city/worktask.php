<?php

class City_WorkTask extends Lisbeth_Entity {
	protected $table = 'cityWorkTasks';

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var string
	 */
	protected $key;

	private function extract() {
		$parts = explode(':', $this->value('task'));

		$this->type = $parts[0];
		$this->key = $parts[1];
	}

	/**
	 * @return string
	 */
	public function type() {
		if (!$this->type) {
			$this->extract();
		}

		return $this->type;
	}

	/**
	 * @return string
	 */
	public function key() {
		if (!$this->key) {
			$this->extract();
		}

		return $this->key;
	}

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

	/**
	 * @return bool
	 */
	public function isProduction() {
		return ($this->type() === 'produce');
	}

	/**
	 * @return bool
	 */
	public function isUpgrade() {
		return ($this->type() === 'upgrade');
	}

	/**
	 * @return Resource_Interface
	 */
	public function resource() {
		return Resource::get(
			$this->key()
		);
	}

	/**
	 * @param City $city
	 * @param City_WorkTasks $workTasks
	 * @return bool
	 */
	public function convert(City $city, City_WorkTasks $workTasks) {
		if (!$this->isCompleted()) {
			return false;
		}

		switch (true) {
			case $this->isProduction():
				$city->increment(
					$this->key(),
					$this->resource()->productionAmount()
				);
				break;

			case $this->isUpgrade():
				$position = $this->value('position');
				$building = $city->buildings()->building($position);

				$level = $building->level() + 1;
				$building->level($level);
				$building->position($position);
				$building->__toCity($city);
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