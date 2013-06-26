<?php

interface Building_Interface {
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
	public function isConstructionSite();

	/**
	 * @return Resource_Interface[]
	 */
	public function goods();

	/**
	 * @return Resource_Interface[]
	 */
	public function requires();

	/**
	 * @param City $city
	 * @param int $position
	 * @return Building_Interface
	 */
	public function build(City $city, $position);

	/**
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