<?php

class Buildings {
	/**
	 * @var Building_Interface[]
	 */
	private $list = array();

	/**
	 * @param City $city
	 * @param string $position
	 */
	public function add(City $city, $position) {
		$data = $city->value($position);

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
			$target->level(
				(int)$data[0]
			);
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