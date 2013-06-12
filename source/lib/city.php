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
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function hasResource(Resource_Interface $resource) {
		$available = $resource->amount($this);
		$required = $resource->productionRequires();

		return ($available >= $required);
	}

	/**
	 * @return array
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

	public function assignWorkTasks() {
		$buildings = $this->buildings();

		/** @var City_WorkTask $workTask */
		foreach ($this->workTasks() as $workTask) {
			$position = $workTask->value('position');
			$buildings->building($position)->setWorkTask($workTask);
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