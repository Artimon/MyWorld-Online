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

			case Building_Forester::KEY:
				return new Building_Forester();

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
}