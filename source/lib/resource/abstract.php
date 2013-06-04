<?php

abstract class Resource_Abstract implements Resource_Interface {
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
	public function createName() {
		return Theme::getInstance()->resolve('create');
	}

	/**
	 * @param City $city
	 * @return int
	 */
	public function amount(City $city) {
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
}