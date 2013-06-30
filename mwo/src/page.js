var mwoApp = angular.module('mwoApp', []);

(function (angular, mwoApp) {
	mwoApp.di = {};
	mwoApp.define = function (name, fn) {
		mwoApp.di[name] = fn;
	};
	mwoApp.retrieve = function (name) {
		if (mwoApp.di[name]) {
			return mwoApp.di[name];
		}
	};

	mwoApp.define('ticker', function (options) {
		var handle, value;

		function kill() {
			window.clearInterval(handle);
		}

		handle = window.setInterval(function () {
			value = --options.object[options.key];

			if (value <= 0) {
				kill();

				if (options.callback) {
					options.callback();
				}
			}

			options.$scope.$apply();
		}, 1000);

		return {
			kill: kill
		}
	});

	angular.module('mwoApp').filter('duration', function () {
		return function (remainingTime) {
			if (remainingTime <= 0) {
				return '-';
			}

			var hours, minutes, seconds;

			hours = parseInt(remainingTime / 3600, 10);
			minutes = parseInt((remainingTime - hours * 3600) / 60, 10);
			seconds = parseInt(remainingTime - hours * 3600 - minutes * 60, 10);

			if (hours > 0) {
				return hours + 'h ' + minutes + 'm';
			}
			else if (minutes > 0) {
				return minutes + 'm ' + seconds + 's';
			}

			return seconds + 's';
		};
	});
}(angular, mwoApp));


(function ($) {
	$.fn.inDom = function () {
		return this.is("html *");
	};

	$.fn.moreGames = function () {
		var $select = this.find('.selectGames'),
			$box = this.find('.gamesBoard'),
			$close = this.find('.close');

		self.hide = function (event) {
			if ($box.is(':visible')) {
				$box.fadeOut();
			}
			else {
				$box.fadeIn();
			}

			event.stopPropagation();
		};

		$box.click(function (event) {
			event.stopPropagation();
		});

		$select.click(self.hide);
		$close.click(self.hide);

		$('body').click(function () {
			if ($box.is(':visible')) {
				$box.fadeOut();
			}
		});

		return this;
	};

	$.fn.loginBox = function () {
		var $this = this,
			$link = $this.find('.showLogin'),
			$box = $this.find('.loginBox'),
			$close = $box.find('.close');

		// @TODO Check for known user cookie and instant-show login box.

		$link.click(function () {
			$link.fadeOut(
				'fast',
				function () {
					$box.fadeIn();
				}
			);
		});

		$close.click(function () {
			$box.fadeOut(
				'fast',
				function () {
					$link.fadeIn();
				}
			);
		});

		return this;
	};
}(jQuery));



(function ($) {
	var selector = '#loader',
		$loader;

	$.fn.showLoader = function () {
		var $this = this,
			left,
			top;

		$loader = $(selector);

		if ($loader.length === 0) {
			$('body').append('<div id="loader"/>');
			$loader = $(selector);
		}

		left = $this.offset().left;
		left += $this.width() / 2;
		left -= 16;

		top = $this.offset().top;
		top += $this.height() / 2;
		top -= 16;

		$loader.css({
			left: Math.round(left) + 'px',
			top: Math.round(top) + 'px'
		});

		$loader.stop().fadeIn('fast');
	};

	$.removeLoader = function () {
		$loader.stop().fadeOut(
			'fast',
			function () {
				$loader.remove();
			}
		);
	}
}(jQuery));


mwoApp.define('cityViewModel', function () {
	/**
	 * City Controller
	 */
	mwoApp.controller('CityCtrl', ['$scope', '$http', function ($scope, $http) {
		var contentBox = $('#cityContentBox');

		$scope.cityId = 0;
		$scope.resources = [];
		$scope.buildings = [];
		$scope.goods = [];

		$scope.currentBuilding = null;
		$scope.contentBoxTitle = '';
		$scope.productionTicker = null;

		$scope.setup = function (cityId, resources, buildings) {
			$scope.cityId = cityId;
			$scope.resources = resources;
			$scope.buildings = buildings;
		};

		$scope.contentBox = {};
		$scope.contentBox.open = function () {
			$scope.killTicker();
			contentBox.fadeIn('fast');
		};
		$scope.contentBox.close = function () {
			$scope.killTicker();
			contentBox.fadeOut('fast');
		};

		/**
		 * @param {string} key
		 * @returns {number}
		 */
		$scope.resourceAvailable = function (key) {
			return $scope.resources[key];
		};

		$scope.registerTicker = function (ware) {
			$scope.productionTicker = mwoApp.retrieve('ticker')({
				$scope: $scope,
				object: ware,
				key: 'remainingTime',
				callback: function () {
					$scope.currentBuilding.state = 'ready';
				}
			});
		};

		$scope.killTicker = function () {
			if ($scope.productionTicker) {
				$scope.productionTicker.kill();
				$scope.productionTicker = null;
			}
		};

		$scope.buildingAction = function (building) {
			return building.state === 'ready' ? 'collect' : 'enter';
		};

		$scope.buildingInteractUrl = function (building) {
			return '?r=building_' + $scope.buildingAction(building) + '/' +
				$scope.cityId + '/' + building.position;
		};

		$scope.buildingInteract = function (building) {
			$scope.currentBuilding = building;

			$('body').showLoader();

			function enterBuilding(json) {
				$scope.contentBoxTitle = json.title;
				$scope.goods = json.goods;

				$scope.contentBox.open();

				$.each($scope.goods, function (key, ware) {
					if (ware.remainingTime > 0) {
						$scope.registerTicker(ware);
						return false;
					}
					return true;
				});
			}

			function collectResources(json) {
				$scope.contentBox.close();
				$scope.resources = json.resources;

				$scope.currentBuilding.state = 'waiting';
				$scope.currentBuilding.isWorking = false;
			}

			var actions = {
				enter: enterBuilding,
				collect: collectResources
			};

			var url = $scope.buildingInteractUrl(building);
			$http.get(url).success(function (data) {
				var action = $scope.buildingAction(building);
				actions[action](data);

				$.removeLoader();
			});
		};

		$scope.produceUrl = function (key) {
			return '?r=resource_produce/' + $scope.cityId + '/' +
				$scope.currentBuilding.position + '/' + key;
		};

		$scope.produce = function (ware) {
			$http.get($scope.produceUrl(ware.key)).success(function (json) {
				$scope.resources = json.resources;

				ware.remainingTime = ware.productionDuration;

				$scope.currentBuilding.state = 'working';
				$scope.currentBuilding.isWorking = true;

				$scope.registerTicker(ware);

				$.removeLoader();
			});
		};
	}]);
});