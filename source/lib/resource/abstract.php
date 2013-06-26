<?php

abstract class Resource_Abstract implements Resource_Interface {
	/**
	 * @var int
	 */
	private $amountRequired = 1;

	/**
	 * @param int $productionRequires
	 */
	public function __construct($productionRequires = 1) {
		$this->amountRequired = (int)$productionRequires;
	}

	/**
	 * @return string
	 */
	public function name() {
		return Theme::getInstance()->resolve(
			$this->key()
		);
	}

	/**
	 * @return string
	 */
	public function productionTypeName() {
		return Theme::getInstance()->resolve('produce');
	}

	/**
	 * @return int
	 */
	public function amountRequired() {
		return $this->amountRequired;
	}

	/**
	 * @param City $city
	 * @return int
	 */
	public function amountAvailable(City $city) {
		return (int)$city->value(
			$this->key()
		);
	}

	/**
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function equals(Resource_Interface $resource) {
		return ($this->key() === $resource->key());
	}

	/**
	 * @param Lisbeth_Entity $entity
	 * @param int $amount
	 * @return Resource_Interface
	 */
	public function add(Lisbeth_Entity $entity, $amount) {
		$entity->increment(
			$this->key(),
			(int)$amount
		);

		return $this;
	}

	/**
	 * @param Lisbeth_Entity $entity
	 * @param $amount
	 * @return Resource_Interface
	 * @throws Resource_InsufficientException
	 */
	public function sub(Lisbeth_Entity $entity, $amount) {
		$amount = (int)$amount;
		$key = $this->key();

		$current = $entity->value($key);
		if ($current - $amount < 0) {
			throw new Resource_InsufficientException();
		}

		return $this->add($entity, -$amount);
	}

	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function produce(
		City $city,
		Building_Interface $building
	) {
		if (!$city->buildings()->has($building)) {
			return false;
		}

		if (!$building->produces($this)) {
			return false;
		}

		$required = $this->requires();
		foreach ($required as $resource) {
			if (!$city->hasResource($resource)) {
				return false;
			}
		}

		foreach ($required as $resource) {
			$city->decrement(
				$resource->key(),
				$resource->amountRequired()
			);
		}

		$task		= "produce:{$this->key()}";
		$completion	= TIME + $this->productionDuration();
		$amount		= $this->productionAmount();

		return City_WorkTask::insert($city, $building, $task, $completion, $amount);
	}
}