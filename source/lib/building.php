<?php

class Building {
	/**
	 * @param string $key
	 * @return Building_Interface
	 */
	public static function get($key) {
		switch ($key) {
			case Building_Council::KEY:
				return new Building_Council();

			case Building_Mine::KEY:
				return new Building_Mine();

			case Building_Logger::KEY:
				return new Building_Logger();

			case Building_Farm::KEY:
				return new Building_Farm();

			case Building_Well::KEY:
				return new Building_Well();

			case Building_TaxCollector::KEY:
				return new Building_TaxCollector();

			case Building_Mill::KEY:
				return new Building_Mill();

			case Building_Smelter::KEY:
				return new Building_Smelter();

			case Building_Sawmill::KEY:
				return new Building_Sawmill();

			case Building_Bakery::KEY:
				return new Building_Bakery();

			case Building_Brewery::KEY:
				return new Building_Brewery();

			case Building_Stable::KEY:
				return new Building_Stable();

			case Building_Forge::KEY:
				return new Building_Forge();

			case Building_Metalworks::KEY:
				return new Building_Metalworks();

			case Building_Warehouse::KEY:
				return new Building_Warehouse();

			case Building_Market::KEY:
				return new Building_Market();

			case Building_Barracks::KEY:
				return new Building_Barracks();

			case Building_Castle::KEY:
				return new Building_Castle();

			default:
				return new Building_Null();
		}
	}

	/**
	 * @return Building_Interface[]
	 */
	public static function keys() {
		return array(
			Building_Council::KEY => new Building_Council(),
			Building_Mine::KEY => new Building_Mine(),
			Building_Logger::KEY => new Building_Logger(),
			Building_Farm::KEY => new Building_Farm(),
			Building_Well::KEY => new Building_Well(),
			Building_TaxCollector::KEY => new Building_TaxCollector(),
			Building_Mill::KEY => new Building_Mill(),
			Building_Smelter::KEY => new Building_Smelter(),
			Building_Sawmill::KEY => new Building_Sawmill(),
			Building_Bakery::KEY => new Building_Bakery(),
			Building_Brewery::KEY => new Building_Brewery(),
			Building_Stable::KEY => new Building_Stable(),
			Building_Forge::KEY => new Building_Forge(),
			Building_Metalworks::KEY => new Building_Metalworks(),
			Building_Warehouse::KEY => new Building_Warehouse(),
			Building_Market::KEY => new Building_Market(),
			Building_Barracks::KEY => new Building_Barracks(),
			Building_Castle::KEY => new Building_Castle()
		);
	}
}