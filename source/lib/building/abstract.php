<?php

abstract class Building_Abstract implements Building_Interface {
	/**
	 * @var int
	 */
	private $level = 0;

	/**
	 * @var string
	 */
	private $position = '';

	/**
	 * @var City_WorkTask
	 */
	private $workTask;

	/**
	 * @param City $city if resource requirements shall be added.
	 * @return array
	 */
	public function __toArray(City $city = null) {
		$state = 'clear';
		$isWorking = false;

		if ($this->valid()) {
			$isWorking = $this->isWorking();
			if ($isWorking) {
				$state = $this->workTask()->isCompleted()
					? 'ready'
					: 'working';
			}
			else {
				$state = 'waiting';
			}
		}

		return array(
			'key' => $this->key(),
			'name' => $this->name(),
			'buildTypeName' => $this->buildTypeName(),
			'level' => $this->level(),
			'position' => $this->position(),
			'isWorking' => $isWorking,
			'state' => $state,
			'canBuild' => $this->canBuild($city),
			'requires' => Resources::__toArray($this->requires(), $city)
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
	public function buildTypeName() {
		return Theme::getInstance()->resolve('build');
	}

	/**
	 * @param int|null $level
	 * @return int|null
	 */
	public function level($level = null) {
		if ($level === null) {
			return $this->level;
		}

		$this->level = (int)$level;

		return null;
	}

	/**
	 * @param int|null $position
	 * @return int|null
	 */
	public function position($position = null) {
		if ($position === null) {
			return $this->position;
		}

		$this->position = (int)$position;

		return null;
	}

	/**
	 * @param City_WorkTask $workTask
	 */
	public function setWorkTask($workTask) {
		$this->workTask = $workTask;
	}

	/**
	 * @return City_WorkTask
	 */
	public function workTask() {
		return $this->workTask;
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function is($key) {
		return ($key === $this->key());
	}

	/**
	 * @return bool
	 */
	public function isConstructionSite() {
		return false;
	}

	/**
	 * @return bool
	 */
	public function isWorking() {
		return ($this->workTask() !== null);
	}

	/**
	 * @param City $city
	 * @param bool $addRequired
	 * @return array
	 */
	public function goodsArray(City $city, $addRequired = false) {
		$result = array();

		foreach ($this->goods() as $ware) {
			$result[] = $ware->__toArray($city, $this, $addRequired);
		}

		return $result;
	}

	/**
	 * @param Resource_Interface $resource
	 * @return bool
	 */
	public function produces(Resource_Interface $resource) {
		foreach ($this->goods() as $ware) {
			if ($resource->equals($ware)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @param City $city
	 * @return bool
	 */
	public function canBuild(City $city) {
		foreach ($this->requires() as $resource) {
			if ($resource->amountRequired() > $resource->amountAvailable($city)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @param City $city
	 * @param int $position
	 * @return Building_Interface
	 * @throws CreationException
	 * @throws CreationException
	 */
	public function build(City $city, $position) {
		$position = (int)$position;
		$city->assertPosition($position);

		if (!$this->isConstructionSite()) {
			throw CreationException::noConstructionSite();
		}

		if (!$city->hasResources($this->requires())) {
			throw CreationException::insufficientResources();
		}

		$city->setValue(
			'building' . $position,
			'0:' . $this->key()
		);

		$this->level(0);
		$this->position($position);

		return $this;
	}

	/**
	 * @return bool
	 */
	public function valid() {
		return true;
	}
}