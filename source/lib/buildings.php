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

			return;
		}

		$data = explode(':', $data);
		if (count($data) !== 2) {
			$target = new Building_Null();

			return;
		}

		$target = Building::get($data[1]);
		if ($target->valid()) {
			$target->level((int)$data[0]);
			$target->position($position);
		}
	}

	public function get() {
		return $this->list;
//		return array(
//			new Building_Council(),
//			new Building_Mine(),
//			new Building_Logger(),
//			new Building_Farm(),
//			new Building_Well(),
//			new Building_TaxCollector(),
//			new Building_Forester(),
//			new Building_Mill(),
//			new Building_Smelter(),
//			new Building_Sawmill(),
//			new Building_Bakery(),
//			new Building_Brewery(),
//			new Building_Stable(),
//			new Building_Forge(),
//			new Building_Metalworks(),
//			new Building_Warehouse(),
//			new Building_Market(),
//			new Building_Barracks(),
//			new Building_Castle()
//		);
	}
}