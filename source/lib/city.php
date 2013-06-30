<?php

class City extends Lisbeth_Entity {
	protected $table = 'cities';

	/**
	 * @const int
	 */
	const BUILDING_SLOTS = 6;

	/**
	 * @var Buildings
	 */
	private $buildings;

	/**
	 * @throws InvalidArgumentException
	 */
	public function assertOnlineOwner() {
		$isOwner = $this->isOwner(
			Game::getInstance()->account()
		);

		if (!$isOwner) {
			throw new InvalidArgumentException("Foreign city.");
		}
	}

	/**
	 * @param int $position
	 * @throws CreationException
	 */
	public function assertPosition($position) {
		$position = (int)$position;

		if ($position < 0 || $position > self::BUILDING_SLOTS) {
			throw CreationException::invalidPosition();
		}
	}

	/**
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function hasResource(Resource_Interface $resource) {
		$available = $resource->amountAvailable($this);
		$required = $resource->amountRequired();

		return ($available >= $required);
	}

	/**
	 * @param Resource_Interface[] $resources
	 * @return bool
	 */
	public function hasResources(array $resources) {
		foreach ($resources as $resource) {
			if (!$this->hasResource($resource)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @return array of [key => amount]
	 */
	public function resourceList() {
		$result = array();

		$resources = Resources::all();
		foreach ($resources as $resource) {
			$key = $resource->key();
			$result[$key] = (int)$this->value($key);
		}

		return $result;
	}

	/**
	 * @return Buildings
	 */
	public function buildings() {
		if (!$this->buildings) {
			$this->buildings = new Buildings($this);
		}

		return $this->buildings;
	}

	/**
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function hasBuilding(Building_Interface $building) {
		return $this->buildings()->has($building);
	}

	/**
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function hasWorkingBuilding(Building_Interface $building) {
		return $this->workTasks()->isWorking($building);
	}

	/**
	 * @param Building_Interface $building
	 * @param Resource_Interface $resource
	 * @return City_WorkTask|null
	 */
	public function remainingProductionTime(
		Building_Interface $building,
		Resource_Interface $resource
	) {
		if (!$this->hasWorkingBuilding($building)) {
			return 0;
		}

		$workTask = $this->workTasks()->workTask($building);

		if (!$workTask->isProduction()) {
			return 0;
		}

		if (!$workTask->resource()->isSame($resource)) {
			return 0;
		}

		return $workTask->remainingTime();
	}

	/**
	 * @return array
	 */
	public function buildingsArray() {
		$result = array();

		foreach ($this->buildings()->all() as $building) {
			$result[] = $building->__toArray();
		}

		return $result;
	}

	/**
	 * Get a list og buildable buildings.
	 *
	 * @return Building_Interface[]
	 */
	public function buildingsBuildable() {
		return $this->buildings()->buildable();
	}

	/**
	 * @param string $key
	 * @param int $position
	 * @return Building_Interface
	 */
	public function buildingBuild($key, $position) {
		return Building::get($key)->build($this, $position);
	}

	/**
	 * @throws Exception
	 */
	public function buildingUpgrade() {
		throw new Exception('@TODO');
	}

	public function assignWorkTasks() {
		$buildings = $this->buildings();

		/** @var City_WorkTask $workTask */
		foreach ($this->workTasks() as $workTask) {
			$position = $workTask->value('position');
			$buildings->setWorkTask($workTask, $position);
		}
	}

	/**
	 * @param int|null $position
	 * @return Building_Interface|City
	 */
	public function currentBuilding($position = null) {
		static $current;

		if ($position) {
			$current = $this->buildings()->building($position);

			return $this;
		}

		return $current;
	}

	/**
	 * @return Account
	 */
	public function owner() {
		return Account::get(
			$this->value('ownerId')
		);
	}

	/**
	 * @return City_WorkTasks
	 */
	public function workTasks() {
		$workTasks = Lisbeth_ObjectPool::get('City_WorkTasks', $this->id());
		$workTasks->setCity($this);

		return $workTasks;
	}

	/**
	 * @param Account $account
	 * @return bool
	 */
	public function isOwner(Account $account) {
		return $this->owner()->isSame($account);
	}
}