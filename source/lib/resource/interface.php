<?php

interface Resource_Interface {
	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @param bool $addRequired
	 * @return array
	 */
	public function __toArray(
		City $city,
		Building_Interface $building = null,
		$addRequired = false
	);

	/**
	 * @return string
	 */
	public function key();

	/**
	 * @return string
	 */
	public function name();

	/**
	 * @return string
	 */
	public function productionTypeName();

	/**
	 * Amount of this resource required to produce another resource.
	 * Is set in each resource's requires() method.
	 *
	 * @return int
	 */
	public function amountRequired();

	/**
	 * @return Resource_Interface[]
	 */
	public function requires();

	/**
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function equals(Resource_Interface $resource);

	/**
	 * @param City $city
	 * @return int
	 */
	public function amountAvailable(City $city);

	/**
	 * @param Lisbeth_Entity $entity
	 * @param int $amount
	 * @return Resource_Interface
	 */
	public function add(Lisbeth_Entity $entity, $amount);

	/**
	 * @param Lisbeth_Entity $entity
	 * @param $amount
	 * @return Resource_Interface
	 * @throws Resource_InsufficientException
	 */
	public function sub(Lisbeth_Entity $entity, $amount);

	/**
	 * @return int
	 */
	public function requiredBuildingLevel();

	/**
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function hasRequiredBuildingLevel(Building_Interface $building);

	/**
	 * @return int
	 */
	public function productionAmount();

	/**
	 * @return int
	 */
	public function productionDuration();

	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function canProduce(City $city, Building_Interface $building);

	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function produce(City $city, Building_Interface $building);

	/**
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function isSame(Resource_Interface $resource);

	// production price -> money = 0
}