<?php

class Cities extends Lisbeth_Collection {
	/**
	 * @param int $cityId
	 * @return City
	 */
	public function city($cityId) {
		return $this->entity($cityId);
	}
}