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
			'goldOre' => new Resource_GoldOre(),
			'boards' => new Resource_Boards(),
			'flour' => new Resource_Flour(),
			'horses' => new Resource_Horses(),
			'bricks' => new Resource_Bricks(),
			'ironIngot' => new Resource_IronIngot(),
			'goldIngot' => new Resource_GoldIngot(),
			'bread' => new Resource_Bread(),
			'swords' => new Resource_Swords()
		);
	}
}





$sql = "
ALTER TABLE  `cities`
ADD `boards` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `ownerId`,
ADD `bread` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `boards`,
ADD `bricks` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `bread`,
ADD `clay` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `bricks`,
ADD `coal` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `clay`,
ADD `flour` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `coal`,
ADD `goldIngot` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `flour`,
ADD `goldOre` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `goldIngot`,
ADD `grain` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `goldOre`,
ADD `horses` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `grain`,
ADD `ironIngot` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `horses`,
ADD `ironOre` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `ironIngot`,
ADD `swords` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `ironOre`,
ADD `water` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `swords`,
ADD `wood` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `water`";