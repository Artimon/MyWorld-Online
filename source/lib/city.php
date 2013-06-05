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
	 * @TODO Remove instant collect and replace with on-click-select.
	 *
	 * @param int $id
	 * @param bool $load
	 */
	public function __construct($id, $load = true) {
		parent::__construct($id, $load);

		$this->workTasks()->complete();
	}

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
	 * @return Buildings
	 */
	public function buildings() {
		if (!$this->buildings) {
			$this->buildings = new Buildings($this);
		}

		return $this->buildings;
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

	public function tempList() {
		$buildings = $this->buildings();

		for ($i = 1; $i <= self::BUILDING_SLOTS; ++$i) {
			$buildings->building($i);
		}

		return $buildings->get();
	}
}