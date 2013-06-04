<?php

class Account extends Lisbeth_Entity {
	protected $table = 'accounts';

	/**
	 * @var Empire
	 */
	private $empire;

	/**
	 * @param int $accountId
	 * @return Account
	 */
	public static function get($accountId) {
		return Lisbeth_ObjectPool::get('Account', $accountId);
	}

	/**
	 * @param Account $account
	 * @return bool
	 */
	public function isSame(Account $account) {
		return ($this->id() === $account->id());
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