<?php

class Buildings {
	const BUILDING_COUNCIL = 'council';
	const BUILDING_MINE = 'mine';
	const BUILDING_LOGGER = 'logger';
	const BUILDING_FARM = 'farm';
	const BUILDING_WELL = 'well';
	const BUILDING_TAX_COLLECTOR = 'taxCollector';
	const BUILDING_FORESTER = 'forester';
	const BUILDING_MILL = 'mill';
	const BUILDING_SMELTER = 'smelter';
	const BUILDING_SAWMILL = 'sawmill';
	const BUILDING_BAKERY = 'bakery';
	const BUILDING_BREWERY = 'brewery';
	const BUILDING_STABLE = 'stable';
	const BUILDING_FORGE = 'forge';
	const BUILDING_METALWORKS = 'metalworks';
	const BUILDING_WAREHOUSE = 'warehouse';
	const BUILDING_MARKET = 'market';
	const BUILDING_BARRACKS = 'barracks';
	const BUILDING_CASTLE = 'castle';

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

		$level = (int)$data[0];
		$key = $data[1];

		switch ($key) {
			case self::BUILDING_COUNCIL:
				$target = new Building_Council();
				break;

			case self::BUILDING_MINE:
				$target = new Building_Mine();
				break;

			case self::BUILDING_LOGGER:
				$target = new Building_Logger();
				break;

			case self::BUILDING_FARM:
				$target = new Building_Farm();
				break;

			case self::BUILDING_WELL:
				$target = new Building_Well();
				break;

			case self::BUILDING_TAX_COLLECTOR:
				$target = new Building_TaxCollector();
				break;

			case self::BUILDING_FORESTER:
				$target = new Building_Forester();
				break;

			case self::BUILDING_MILL:
				$target = new Building_Mill();
				break;

			case self::BUILDING_SMELTER:
				$target = new Building_Smelter();
				break;

			case self::BUILDING_SAWMILL:
				$target = new Building_Sawmill();
				break;

			case self::BUILDING_BAKERY:
				$target = new Building_Bakery();
				break;

			case self::BUILDING_BREWERY:
				$target = new Building_Brewery();
				break;

			case self::BUILDING_STABLE:
				$target = new Building_Stable();
				break;

			case self::BUILDING_FORGE:
				$target = new Building_Forge();
				break;

			case self::BUILDING_METALWORKS:
				$target = new Building_Metalworks();
				break;

			case self::BUILDING_WAREHOUSE:
				$target = new Building_Warehouse();
				break;

			case self::BUILDING_MARKET:
				$target = new Building_Market();
				break;

			case self::BUILDING_BARRACKS:
				$target = new Building_Barracks();
				break;

			case self::BUILDING_CASTLE:
				$target = new Building_Castle();
				break;

			default:
				$level = 0;
				$target = new Building_Null();
				break;
		}

		$target->level($level);
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