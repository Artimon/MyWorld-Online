

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
	};

	$.fn.buildingInteract = function () {
		this.click(function (event) {
			var $link = $(this),
				$building = $link.parent(),
				action = $link.data('action'),
				actions;

			event.preventDefault();
			$('body').showLoader();

			function enterBuilding(html) {
				$('#buildingBox').html(html).fadeIn('fast');
			}

			function collectResources(json) {
				$.updateResources(json.resources);
				console.log(json);
				$building.find('.buildingInteract').data('action', 'enter');
			}

			actions = {
				enter: enterBuilding,
				collect: collectResources
			};

			$.get($link.data(action))
				.success(function (data) {
					$('.buliding').removeClass('active');
					$building.addClass('active');

					actions[action](data);

					$.removeLoader();
				});
		})
	};

	$.fn.buildingBox = function () {
		var $buildingBox = $(this),
			$close = $buildingBox.find('.close');

		$close.click(function () {
			$.bindings.clear('buildingBox');
			$buildingBox.fadeOut('fast');
		});

		$.bindings.create('buildingBox');
		$.bindings.add('buildingBox', $close);
	};

	$.fn.produce = function ($container) {
		var $links = this;

		$.bindings.add('buildingBox', $links);

		$links.click(function (event) {
			var $link = $(this);

			$links.addClass('disabled');

			event.preventDefault();
			$container.showLoader();

			$.get($link.attr('href'))
				.success(function (json) {
					$.updateResources(json.resources);
					console.log(json);
					var selector = $link.data('reference'),
						duration = $link.data('duration'),
						$building = $('.building.active');

					window.setTimeout(
						function () {
							$building.find('.buildingInteract').data('action', 'collect');
						},
						duration * 1000
					);


					$(selector).ticker(duration);

					$.removeLoader();
				})
		});
	};

	$.fn.ticker = function (remainingTime, callback) {
		var $ticker = this,
			handle;

		handle = window.setInterval(
			function () {
				if (--remainingTime <= 0) {
					window.clearInterval(handle);
					$ticker.text('-');

					if (callback) {
						callback();
					}

					return;
				}

				if (!$ticker.inDom()) {
					window.clearInterval(handle);

					console.log('Ticker has been removed...');

					return;
				}

				var result, hours, minutes, seconds;

				hours = parseInt(remainingTime / 3600, 10);
				minutes = parseInt((remainingTime - hours * 3600) / 60, 10);
				seconds = parseInt(remainingTime - hours * 3600 - minutes * 60, 10);

				if (hours > 0) {
					result = hours + 'h ' + minutes + 'm';
				}
				else if (minutes > 0) {
					result = minutes + 'm ' + seconds + 's';
				}
				else {
					result = seconds + 's';
				}

				$ticker.text(result);
			},
			1000
		);
	};

	$.updateResources = function (resources) {
		for (var key in resources) {
			if (resources.hasOwnProperty(key)) {
				$('.resource_' + key).text(resources[key]);
			}
		}
	};


	$.bindings = {
		list: {}
	};

	$.bindings.clear = function (namespace) {
		console.log('Clear: ' + namespace);
		if (!$.bindings.list[namespace]) {
			return;
		}

		$.each($.bindings.list[namespace], function (key, $binding) {
			$binding.unbind();
		});

		delete $.bindings.list[namespace];
	};

	$.bindings.create = function (namespace) {
		$.bindings.clear(namespace);
		console.log('Create: ' + namespace);

		$.bindings.list[namespace] = [];
	};

	$.bindings.add = function (namespace, $binding) {
		$.bindings.list[namespace].push($binding);
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