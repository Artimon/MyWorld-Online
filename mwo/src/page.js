var mwoApp = angular.module('mwoApp', []);

(function ($, angular, mwoApp) {
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

	mwoApp.service('router', function () {
		var service = {};
		/**
		 * @param {string} route
		 * @param {string[]} parameters
		 * @returns {string}
		 */
		service.buildUrl = function (route, parameters) {
			return '?r=' + route + '/' + parameters.join('/');
		};

		return service;
	});

	mwoApp.service('response', function () {
		var service = {},
			$response = $('#response'),
			handle;

		/**
		 * @param {object} element
		 * @returns {object}
		 */
		service.position = function (element) {
			var $element = $(element),
				offset = $element.offset();

			$response.css({
				left: offset.left + $element.width() - 24,
				top: offset.top + $element.height() - 24
			});

			return service;
		};

		/**
		 * @returns {object}
		 */
		service.show = function () {
			if (!$response.is(':visible')) {
				$response.fadeIn();
			}

			if (handle) {
				window.clearTimeout(handle);
			}

			handle = window.setTimeout(function () {
				handle = null;
				$response.fadeOut('slow');
			}, 2000);

			return service;
		};

		/**
		 * @param {object} element
		 */
		service.loading = function (element) {
			$response.removeClass('success error').addClass('loading');
			service.position(element).show();
		};

		/**
		 * @param {object} element
		 */
		service.success = function (element) {
			$response.removeClass('loading error').addClass('success');
			service.position(element).show();
		};

		return service;
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
}(jQuery, angular, mwoApp));


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


/**
 * City Controller
 */
mwoApp.controller(
	'CityCtrl',
	[
		'$scope', '$http', 'router', 'response',
		function ($scope, $http, router, response) {
			var contentBox = $('#cityContentBox');

			$scope.cityId = 0;
			$scope.resources = [];
			$scope.buildings = [];
			$scope.goods = [];

			$scope.isConstructionSite = false;
			$scope.buildable = [];

			$scope.currentBuilding = null;
			$scope.contentBoxTitle = '';
			$scope.ticker = {};

			$scope.setup = function (cityId, resources, buildings) {
				$scope.cityId = cityId;
				$scope.resources = resources;
				$scope.buildings = buildings;
			};

			$scope.contentBox = {};
			$scope.contentBox.open = function () {
				contentBox.fadeIn('fast');
			};
			$scope.contentBox.close = function () {
				contentBox.fadeOut('fast');
			};

			$scope.ticker.list = {};
			$scope.ticker.register = function (data, callback) {
				var key = $scope.currentBuilding.position - 1,
					ticker = mwoApp.retrieve('ticker')({
						$scope: $scope,
						object: data,
						key: 'remainingTime',
						callback: function () {
							callback($scope.buildings[key]);
						}
					});

				if ($scope.ticker.list[key]) {
					$scope.ticker.list[key].kill();
				}

				$scope.ticker.list[key] = ticker;
			};

			$scope.ticker.production = function (data) {
				$scope.ticker.register(data, function (building) {
					building.state = 'ready';
				});
			};

			$scope.ticker.upgrade = function (data) {
				$scope.ticker.register(data, function (building) {
					building.level += 1;
					building.state = 'waiting';
				});
			};

			$scope.buildingAction = function (building) {
				return building.state === 'ready' ? 'collect' : 'enter';
			};

			$scope.buildingInteractUrl = function (building) {
				return router.buildUrl(
					'building_' + $scope.buildingAction(building),
					[$scope.cityId, building.position]
				);
			};

			$scope.buildingInteract = function (building) {
				$scope.currentBuilding = building;

				$('body').showLoader();

				function enterBuilding(json) {
					$scope.isConstructionSite = json.isConstructionSite;
					$scope.contentBoxTitle = json.title;
					$scope.buildable = json.buildable;
					$scope.goods = json.goods;

					$scope.contentBox.open();

					$.each($scope.goods, function (key, ware) {
						if (ware.remainingTime > 0) {
							$scope.ticker.production(ware);
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

			/**
			 * @param {object} building
			 * @param {string }key
			 * @returns {string}
			 */
			$scope.buildingBuildUrl = function (building, key) {
				return router.buildUrl(
					'building_build',
					[$scope.cityId, building.position, key]
				);
			};

			$scope.buildingBuild = function (key) {
				var url = $scope.buildingBuildUrl(
					$scope.currentBuilding,
					key
				);

				$http.get(url).success(function (data) {
					if (data.error) {
						console.log('Error: ', data.message);
					}
					else {
						$scope.contentBox.close();
						$scope.buildings = data.buildings;
						$scope.resources = data.resources;

						$scope.currentBuilding = $scope.buildings[
							$scope.currentBuilding.position - 1
						];

						$scope.ticker.upgrade($scope.currentBuilding);
					}
				});
			};

			/**
			 * @param {string} key
			 * @returns {string}
			 */
			$scope.produceUrl = function (key) {
				return router.buildUrl(
					'resource_produce',
					[$scope.cityId, $scope.currentBuilding.position, key]
				);
			};

			$scope.produce = function (ware, $event) {
				var $link = angular.element($event.srcElement);
				response.loading($link);

				$http.get($scope.produceUrl(ware.key)).success(function (json) {
					response.success($link);

					$scope.resources = json.resources;

					ware.remainingTime = ware.productionDuration;

					$scope.currentBuilding.state = 'working';
					$scope.currentBuilding.isWorking = true;

					$scope.ticker.production(ware);
				});
			};
		}
	]
);