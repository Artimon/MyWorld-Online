<?php

class ViewHelper_Building extends ViewHelper_Abstract {
	/**
	 * @var Building_Interface
	 */
	private $building;

	/**
	 * @param Building_Interface $building
	 */
	public function __construct(Building_Interface $building) {
		$this->building = $building;
	}

	/**
	 * @param Building_Interface $building
	 * @return ViewHelper_Building
	 */
	public static function create(Building_Interface $building) {
		return new self($building);
	}

	/**
	 * @return string
	 */
	public function get() {
		$iconClass = '';
		$action = 'build';

		if ($this->building->valid()) {
			$action = 'enter';

			$workTask = $this->building->workTask();
			if ($workTask) {
				$hasFinishedWork = $workTask->isCompleted();

				if ($hasFinishedWork) {
					$action = 'collect';
				}
				else {
					$iconClass = 'entypo-flag';
				}
			}
			else {
				$iconClass = 'entypo-dot-3';
			}
		}

		return "
			<div class='building' data-position='{$this->building->position()}'>
				{$this->building->name()}
				({$this->building->level()})
				<span class='icon'>
					<span class='{$iconClass}'></span>
				</span> -
				<a href='javascript:;' class='interact'
					data-action='{$action}'>
					collect/show/build - {$action}
				</a>
			</div>";
	}
}