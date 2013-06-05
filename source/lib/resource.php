<?php

class Resource {
	/**
	 * @param string $key
	 * @return Resource_Interface
	 * @throws InvalidArgumentException
	 */
	public static function get($key) {
		switch ($key) {
			case Resource_IronOre::KEY:
				return new Resource_IronOre();

			case Resource_GoldOre::KEY:
				return new Resource_GoldOre();

			case Resource_Coal::KEY:
				return new Resource_Coal();

			case Resource_Grain::KEY:
				return new Resource_Grain();

			default:
				throw new InvalidArgumentException("Resource '{$key}' unknown.");
		}
	}
}