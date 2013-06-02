<?php

class Empire {
	/**
	 * @var Account
	 */
	private $owner;

	/**
	 * @param Account $owner
	 */
	public function __construct(Account $owner) {
		$this->owner = $owner;
	}

	/**
	 * @return Cities
	 */
	public function cities() {
		return Lisbeth_ObjectPool::get('Cities', $this->owner->id());
	}
}