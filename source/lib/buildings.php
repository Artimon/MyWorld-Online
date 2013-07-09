<?php

class Buildings {
	/**
	 * @var Building_Interface[]
	 */
	private $list = array();

	/**
	 * @var City
	 */
	private $city;

	/**
	 * @param City $city
	 */
	public function __construct(City $city) {
		$this->city = $city;
	}

	/**
	 * @param Building_Interface[] $buildings
	 * @param City $city if resource requirements shall be added.
	 * @return array
	 */
	public static function __toArray(array $buildings, City $city = null) {
		$result = array();

		foreach ($buildings as $building) {
			$result[] = $building->__toArray($city);
		}

		return $result;
	}

	/**
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function has(Building_Interface $building) {
		return $this->building($building->position())->valid();
	}

	/**
	 * @param string $position
	 * @return Building_Interface
	 */
	public function building($position) {
		$position = (int)$position;

		if (!array_key_exists($position, $this->list)) {
			$this->add($position);
		}

		return $this->list[$position];
	}

	/**
	 * @param int $position
	 * @throws InvalidArgumentException
	 */
	public function add($position) {
		$position = (int)$position;

		if ($position < 0 || $position > City::BUILDING_SLOTS) {
			throw new InvalidArgumentException("Position '{$position}' invalid.");
		}

		$data = $this->city->value('building' . $position);

		$this->list[$position] = null;
		$target = &$this->list[$position];

		if (empty($data)) {
			$target = new Building_Null();
			$target->position($position);

			return;
		}

		$data = explode(':', $data);
		if (count($data) !== 2) {
			$target = new Building_Null();
			$target->position($position);

			return;
		}

		$target = Building::get($data[1]);
		if ($target->valid()) {
			$target->level((int)$data[0]);
			$target->position($position);
		}
	}

	/**
	 * @param Building_Interface $building
	 * @param int $position
	 */
	public function replace(Building_Interface $building, $position) {
		$this->list[(int)$position] = $building;
	}

	/**
	 * @return Building_Interface[]
	 */
	public function all() {
		for ($i = 1; $i <= City::BUILDING_SLOTS; ++$i) {
			$this->building($i);
		}

		ksort($this->list);

		return $this->list;
	}

	/**
	 * @TODO Add level condition.
	 *
	 * @return Building_Interface[]
	 */
	public function buildable() {
		$buildings = Building::keys();
		$list = $buildings;

		foreach ($list as &$value) {
			$value = 0;
		}

		foreach ($this->all() as $building) {
			if (!$building->valid()) {
				continue;
			}

			$key = $building->key();
			if (!array_key_exists($key, $buildings)) {
				continue;
			}

			++$list[$key];
			if ($list[$key] >= $buildings[$key]->maximumNumber()) {
				unset($buildings[$key]);
			}
		}

		return $buildings;
	}

	/**
	 * @param City_WorkTask $workTask
	 * @param string $position
	 * @return Building_Interface
	 */
	public function setWorkTask(City_WorkTask $workTask, $position) {
		$building = $this->building($position);
		$building->setWorkTask($workTask);

		return $building;
	}
}