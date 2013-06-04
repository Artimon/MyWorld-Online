<?php

class Cities extends Lisbeth_Collection {
	protected $table = 'cities';
	protected $group = 'ownerId';
	protected $order = 'id';
	protected $entityName = 'City';

	/**
	 * @param int $cityId
	 * @return City|null
	 */
	public function city($cityId) {
		return $this->entity($cityId);
	}
}