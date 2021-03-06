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
	 * @param Resource_Interface[] $resources
	 */
	public function removeResources($resources) {
		foreach ($resources as $resource) {
			$this->decrement(
				$resource->key(),
				$resource->amountRequired()
			);
		}
	}

	/**
	 * @param Resource_Interface[] $resources
	 */
	public function addResources($resources) {
		foreach ($resources as $resource) {
			$this->increment(
				$resource->key(),
				$resource->amountRequired()
			);
		}
	}

	/**
	 * @param Building_Interface $building
	 * @param bool $addRequired
	 * @return array of [key => amount]
	 */
	public function resourcesArray(
		Building_Interface $building = null,
		$addRequired = false
	) {
		return Resources::__toArray(
			Resources::all(),
			$this,
			$building,
			$addRequired
		);
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
		return Buildings::__toArray(
			$this->buildings()->all(),
			$this
		);
	}

	/**
	 * Get a list of buildable buildings.
	 *
	 * @param int $position
	 * @return Building_Interface[]
	 */
	public function buildingsBuildable($position) {
		return $this->buildings()->buildable($position);
	}

	/**
	 * @param string $key
	 * @param int $position
	 * @return bool
	 */
	public function buildingBuild($key, $position) {
		$building = Building::get($key);

		if ($building->canBuild($this, $position)) {
			$this->buildings()->replace($building, $position);
			$building->build($this, $position);

			return true;
		}

		return false;
	}

	/**
	 * @param int $position
	 * @return bool
	 */
	public function buildingUpgrade($position) {
		$building = $this->buildings()->building($position);

		if ($building->canUpgrade($this)) {
			$building->upgrade($this);

			return true;
		}

		return false;
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
	 * @param $position
	 * @return Building_Interface
	 */
	public function building($position) {
		return $this->buildings()->building($position);
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

	/**
	 * @param int $position
	 * @return bool
	 */
	public function isConstructionSite($position) {
		return !$this->value('building' . (int)$position);
	}
}