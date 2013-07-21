<?php

class Resources {
	/**
	 * @return Resource_Interface[]
	 */
	public static function all() {
		return array(
			'wood' => new Resource_Wood(),
			'grain' => new Resource_Grain(),
			'water' => new Resource_Water(),
			'clay' => new Resource_Clay(),
			'coal' => new Resource_Coal(),
			'ironOre' => new Resource_IronOre(),
			'goldOre' => new Resource_CopperOre(),
			'boards' => new Resource_Boards(),
			'flour' => new Resource_Flour(),
			'horses' => new Resource_Horses(),
			'bricks' => new Resource_Bricks(),
			'ironIngot' => new Resource_IronIngot(),
			'goldIngot' => new Resource_BronzeIngot(),
			'bread' => new Resource_Bread(),
			'beer' => new Resource_Beer(),
			'swords' => new Resource_Swords()
		);
	}

	/**
	 * @param Resource_Interface[] $resources
	 * @param City $city
	 * @param Building_Interface $building
	 * @param bool $addRequired
	 * @return array
	 */
	public static function __toArray(
		array $resources,
		City $city,
		Building_Interface $building = null,
		$addRequired = false
	) {
		$result = array();

		foreach ($resources as $resource) {
			$result[$resource->key()] = $resource->__toArray($city, $building, $addRequired);
		}

		return $result;
	}
}