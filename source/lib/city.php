<?php

class City extends Lisbeth_Entity {
	/**
	 * @const int
	 */
	const BUILDING_SLOTS = 3;

	/**
	 * Mock
	 * @param int $id
	 */
	public function __construct($id) {
	}

	/**
	 * DB Mock override.
	 *
	 * @param string $index
	 * @return string
	 */
	public function value($index) {
		$data = array(
			'building1' => '1:council',
			'building2' => '',
			'building3' => '2:mine'
		);

		return $data[$index];
	}

	/**
	 * @param Account $account
	 * @return bool
	 */
	public function isOwner(Account $account) {
		return true; // @TODO Add check.
	}

	public function tempList() {
		$buildings = new Buildings();

		for ($i = 1; $i <= self::BUILDING_SLOTS; ++$i) {
			$buildings->add($this, 'building' . $i);
		}

		return $buildings->get();
	}
}