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
	 * @param City $city
	 * @param Building_Interface $building
	 * @param bool $addRequired
	 * @return array
	 */
	public function __toArray(
		City $city,
		Building_Interface $building = null,
		$addRequired = false
	) {
		$requires = array();
		if ($addRequired) {
			foreach ($this->requires() as $resource) {
				$requires[] = $resource->__toArray($city);
			}
		}

		$canProduce = false;
		$remainingTime = 0;
		if ($building) {
			$canProduce = $this->canProduce($city, $building);

			if ($city->hasWorkingBuilding($building)) {
				$remainingTime = $city->remainingProductionTime($building, $this);
			}
		}

		return array(
			'key' => $this->key(),
			'url' => 'tmp/resource_dummy.gif',
			'name' => $this->name(),
			'productionTypeName' => $this->productionTypeName(),
			'productionDuration' => $this->productionDuration(),
			'productionAmount' => $this->productionAmount(),
			'canProduce' => $canProduce,
			'remainingTime' => $remainingTime,
			'amountRequired' => $this->amountRequired(),
			'amountAvailable' => $this->amountAvailable($city),
			'insufficient' => $this->isInsufficient($city),
			'requires' => $requires
		);
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
	 * @param City $city
	 * @return bool
	 */
	public function isInsufficient(City $city) {
		return ($this->amountRequired() > $this->amountAvailable($city));
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
	 * @return int
	 */
	public function requiredBuildingLevel() {
		return 1;
	}

	/**
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function hasRequiredBuildingLevel(Building_Interface $building) {
		return ($building->level() >= $this->requiredBuildingLevel());
	}

	/**
	 * @param City $city
	 * @param Building_Interface $building
	 * @return bool
	 */
	public function canProduce(
		City $city,
		Building_Interface $building
	) {
		if (!$city->hasBuilding($building)) {
			return false;
		}

		if (!$building->produces($this)) {
			return false;
		}

		if ($building->isWorking($city)) {
			return false;
		}

		if (!$this->hasRequiredBuildingLevel($building)) {
			return false;
		}

		$required = $this->requires();
		foreach ($required as $resource) {
			if (!$city->hasResource($resource)) {
				return false;
			}
		}

		return true;
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
		if (!$this->canProduce($city, $building)) {
			return false;
		}

		$required = $this->requires();
		foreach ($required as $resource) {
			$city->decrement(
				$resource->key(),
				$resource->amountRequired()
			);
		}

		$task		= "produce:{$this->key()}";
		$completion	= TIME + $this->productionDuration();
		$amount		= $this->productionAmount();

		$success = City_WorkTask::insert($city, $building, $task, $completion, $amount);

		$city->assignWorkTasks();

		return $success;
	}

	/**
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function isSame(Resource_Interface $resource) {
		return ($resource->key() === $this->key());
	}
}