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
		return array(
			'key' => $this->key(),
			'name' => $this->name(),
			'buildTypeName' => $this->buildTypeName(),
			'level' => $this->level(),
			'position' => $this->position(),
			'isWorking' => $this->isWorking(),
			'state' => $this->state(),
			'canBuild' => $this->canBuild($city),
			'remainingTime' => $this->remainingTime(),
			'requires' => Resources::__toArray($this->requires(), $city)
		);
	}

	/**
	 * @return string
	 */
	protected function state() {
		if (!$this->valid()) {
			return 'clear';
		}

		if (!$this->isWorking()) {
			return 'waiting';
		}

		$workTask = $this->workTask();
		if ($workTask->isCompleted()) {
			return 'ready';
		}

		if ($workTask->isProduction()) {
			return 'working';
		}

		return 'upgrading';
	}

	/**
	 * Seconds until the upgrade is finished.
	 *
	 * @return int
	 */
	public function remainingTime() {
		if (!$this->isWorking()) {
			return 0;
		}

		$workTask = $this->workTask();
		if (!$workTask->isUpgrade()) {
			return 0;
		}

		return $workTask->completion() - TIME;
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
	 * @param int|null $level [1-4]
	 * @throws CreationException
	 * @return Resource_Interface[]
	 */
	public function requires($level = null) {
		if (!$level) {
			$level = $this->level() + 1;
		}

		switch ($level) {
			case 1:
				return $this->requiresBuild();

			case 2:
				return $this->requiresUpgrade1();

			case 3:
				return $this->requiresUpgrade2();

			case 4:
				return $this->requiresUpgrade3();

			default:
				return array();
		}
	}

	/**
	 * @return Resource_Interface[]
	 */
	abstract protected function requiresBuild();

	/**
	 * @return Resource_Interface[]
	 */
	abstract protected function requiresUpgrade1();

	/**
	 * @return Resource_Interface[]
	 */
	abstract protected function requiresUpgrade2();

	/**
	 * @return Resource_Interface[]
	 */
	abstract protected function requiresUpgrade3();

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
	 */
	public function __toCity(City $city) {
		$key = 'building' . $this->position();
		$value = $this->level() . ':' . $this->key();

		$city->setValue($key, $value);
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

		$this->level(0);
		$this->position($position);

		$city->assertPosition($position);
		if (!$city->isConstructionSite($position)) {
			throw CreationException::noConstructionSite();
		}

		if (!$city->hasResources($this->requires())) {
			throw CreationException::insufficientResources();
		}

		$this->__toCity($city);

		City_WorkTask::insert(
			$city,
			$this,
			"upgrade:{$this->key()}",
			TIME + 5, // @TODO Insert duration.
			1
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