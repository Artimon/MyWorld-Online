<?php

class Account extends Lisbeth_Entity {
	private $empire;

	/**
	 * @param int $accountId
	 * @return Account
	 */
	public static function get($accountId) {
		return Lisbeth_ObjectPool::get('Account', $accountId);
	}

	/**
	 * @return Empire
	 */
	public function empire() {
		if (!$this->empire) {
			$this->empire = new Empire($this);
		}

		return $this->empire;
	}
}