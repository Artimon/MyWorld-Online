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
	 * @return string
	 */
	public function name() {
		return Theme::getInstance()->resolve(
			$this->key()
		);
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
	 * @return bool
	 */
	public function valid() {
		return true;
	}
}