var mwoApp = angular.module('mwoApp', []);

(function ($, angular, mwoApp, translations) {
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

	mwoApp.filter('duration', function () {
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

	mwoApp.filter('i18n', function () {
		return function (translationKey) {
			if (translations[translationKey]) {
				return translations[translationKey];
			}

			return translationKey;
		};
	});

	mwoApp.filter('image', function () {
		return function (image) {
			return '/myworld-online/mwo/img/' + image;
//			return '/mwo/images/' + image;
		};
	});
}(jQuery, angular, mwoApp, translations));


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
			$scope.buildable = [];

			$scope.currentBuilding = null;
			$scope.contentBoxTitle = '';
			$scope.ticker = {};

			$scope.setup = function (cityId, resources, buildings) {
				$scope.cityId = cityId;
				$scope.resources = resources;
				$scope.buildings = buildings;

				$scope.registerConstructionTicker();
			};

			$scope.registerConstructionTicker = function () {
				$.each($scope.buildings, function (key, building) {
					$scope.registerProductionTicker(building);

					if (building.remainingTime) {
						$scope.ticker.construction(building);
					}
				});
			};

			/**
			 * @param {object} building
			 */
			$scope.registerProductionTicker = function (building) {
				$.each(building.goods, function (key, ware) {
					if (ware.remainingTime) {
						$scope.ticker.production(building, ware);
					}
				});
			};

			$scope.contentBox = {};
			$scope.contentBox.open = function () {
				contentBox.fadeIn('fast');
			};
			$scope.contentBox.close = function () {
				contentBox.fadeOut('fast');
			};

			$scope.ticker.list = {};
			$scope.ticker.register = function (building, data, callback) {
				var key = building.position - 1,
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

			$scope.ticker.production = function (building, resource) {
				$scope.ticker.register(building, resource, function (building) {
					building.state = 'ready';
				});
			};

			$scope.ticker.construction = function (building) {
				/*
				 * Create url immediately, since it gets crated from
				 * current building, which may change during build time.
				 */
				var url = $scope.actionUrl('building', '');
				$scope.ticker.register(building, building, function () {
					$http.get(url).success(function (json) {
						$scope.replaceBuilding(json);
					});
				});
			};

			/**
			 * @param {string} route
			 * @param {string }key
			 * @returns {string}
			 */
			$scope.actionUrl = function (route, key) {
				return router.buildUrl(route, [
					$scope.cityId, $scope.currentBuilding.position, key
				]);
			};

			/**
			 * Replaces the current building by the given one.
			 * Also updates the current building if still the same.
			 *
			 * @param building
			 */
			$scope.replaceBuilding = function (building) {
				var key = building.position - 1;

				$scope.buildings[key] = building;

				if ($scope.currentBuilding.position === building.position) {
					$scope.currentBuilding = building;
				}
			};

			/**
			 * @param {object} building
			 */
			$scope.buildingInteract = function (building) {
				$scope.currentBuilding = building;

				function collectResources() {
					$('body').showLoader();

					var url = $scope.actionUrl('building_collect', '');
					$http.get(url).success(function (json) {
						$scope.contentBox.close();
						$scope.resources = json.resources;

						$scope.replaceBuilding(json.building);

						$.removeLoader();
					});
				}

				function buildableBuildings() {
					$('body').showLoader();

					$scope.contentBoxTitle = 'emptyConstructionSite';
					$scope.contentBox.open();

					var url = $scope.actionUrl('building_buildable', '')
					$http.get(url).success(function (buildable) {
						$scope.buildable = buildable;

						$.removeLoader();
					})
				}

				function enterBuilding() {
					$scope.contentBoxTitle = building.name;
					$scope.contentBox.open();
				}

				/*
				 * Allows us to define more fine action depending on the building state.
				 */
				var actions = {
					ready: collectResources,
					waiting: enterBuilding,
					upgrading: enterBuilding,
					clear: buildableBuildings,
					working: enterBuilding
				};

				actions[building.state]();
			};

			/**
			 * @param {string} route
			 * @param {string }key
			 * @returns {string}
			 */
			$scope.actionUrl = function (route, key) {
				return router.buildUrl(route, [
					$scope.cityId, $scope.currentBuilding.position, key
				]);
			};

			$scope.build = function (key, canBuild) {
				if (!canBuild) {
					return;
				}

				var url = $scope.actionUrl('building_build', key);
				$http.get(url).success(function (json) {
					$scope.contentBox.close();
					$scope.resources = json.resources;

					$scope.replaceBuilding(json.building);

					$scope.ticker.construction($scope.currentBuilding);
				});
			};

			$scope.upgrade = function ($event) {
				if (!$scope.currentBuilding.canUpgrade) {
					return;
				}

				var $link = angular.element($event.srcElement),
					url = $scope.actionUrl(
						'building_upgrade',
						$scope.currentBuilding.key
					);

				response.loading($link);

				$http.get(url).success(function (json) {
					response.success($link);

					$scope.resources = json.resources;

					$scope.replaceBuilding(json.building);

					$scope.ticker.construction($scope.currentBuilding);
				});
			};

			$scope.produce = function (ware, $event) {
				if (!ware.canProduce) {
					return;
				}

				var $link = angular.element($event.srcElement),
					url = $scope.actionUrl('resource_produce', ware.key);

				response.loading($link);

				$http.get(url).success(function (json) {
					response.success($link);

					$scope.resources = json.resources;

					ware.remainingTime = ware.productionDuration;

					$scope.replaceBuilding(json.building);

					$.each(json.building.goods, function (key, newWare) {
						if (ware.key === newWare.key) {
							$scope.ticker.production(
								$scope.currentBuilding,
								newWare
							);
						}
					});
				});
			};
		}
	]
);