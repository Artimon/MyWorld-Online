<?php

class Resource {
	/**
	 * @param string $key
	 * @return Resource_Interface
	 * @throws InvalidArgumentException
	 */
	public static function get($key) {
		$resources = Resources::all();

		if (array_key_exists($key, $resources)) {
			return $resources[$key];
		}

		throw new InvalidArgumentException("Resource '{$key}' unknown.");
	}
}