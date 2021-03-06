<?php

interface Building_Interface {
	/**
	 * @param City $city if resource requirements shall be added.
	 * @return array
	 */
	public function __toArray(City $city = null);

	/**
	 * @param City $city
	 */
	public function __toCity(City $city);

	/**
	 * @return string
	 */
	public function key();

	/**
	 * @return string
	 */
	public function name();

	/**
	 * @param int|null $level
	 * @return int
	 */
	public function level($level = null);

	/**
	 * @param int|null $position
	 * @return int
	 */
	public function position($position = null);

	/**
	 * @param City_WorkTask $workTask
	 */
	public function setWorkTask($workTask);

	/**
	 * @return City_WorkTask
	 */
	public function workTask();

	/**
	 * @param string $key
	 * @return bool
	 */
	public function is($key);

	/**
	 * @return bool
	 */
	public function isWorking();

	/**
	 * @return Resource_Interface[]
	 */
	public function goods();

	/**
	 * @param City $city
	 * @param bool $addRequired
	 * @return array
	 */
	public function goodsArray(City $city, $addRequired = true);

	/**
	 * @param int|null $level [1-4]
	 * @throws CreationException
	 * @return Resource_Interface[]
	 */
	public function requires($level = null);

	/**
	 * @param City $city
	 * @param int $position
	 * @return bool
	 */
	public function canBuild(City $city, $position);

	/**
	 * @param City $city
	 * @param int $position
	 * @return Building_Interface
	 */
	public function build(City $city, $position);

	/**
	 * @param City $city
	 * @return bool
	 */
	public function canUpgrade(City $city);

	/**
	 * @param City $city
	 * @return bool
	 */
	public function upgrade(City $city);

	/**
	 * Return whether this resource is produced by the building or not.
	 *
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function produces(Resource_Interface $resource);

	/**
	 * @return int
	 */
	public function maximumNumber();

	/**
	 * @return bool
	 */
	public function valid();
}