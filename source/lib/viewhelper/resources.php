<?php

class ViewHelper_Resources extends ViewHelper_Abstract {
	/**
	 * @var Resource_Interface[]
	 */
	private $resources = array();

	/**
	 * @var City|null
	 */
	private $city;

	/**
	 * @return ViewHelper_Resources
	 */
	public static function create() {
		return new self();
	}

	/**
	 * @param Resource_Interface[] $resources
	 * @return ViewHelper_Resources
	 */
	public function setResources(array $resources) {
		$this->resources = $resources;

		return $this;
	}

	/**
	 * @param City $city
	 * @return ViewHelper_Resources
	 */
	public function setSource(City $city) {
		$this->city = $city;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get() {
		$list = '';
		foreach ($this->resources as $resource) {
			$class = '';
			$required = $resource->amountRequired();
			if ($this->city) {
				$available = $resource->amountAvailable($this->city);
				if ($required > $available) {
					$class = " class='insufficient'";
				}
			}

			$list .= "<li{$class}>{$required} [{$resource->name()}]</li>";
		}

		return "<div class='resourceList'><ul>{$list}</ul><div class='clear'></div></div>";
	}
}