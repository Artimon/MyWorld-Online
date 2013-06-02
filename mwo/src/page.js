

(function ($) {
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

	$.fn.showBuilding = function () {
		this.click(function (event) {
			var $link = $(this);

			event.preventDefault();

			$.get($link.attr('href'))
				.success(function (html) {
					$('#buildingBox').html(html).fadeIn('fast');
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


	$.bindings = {
		list: {}
	};

	$.bindings.clear = function (namespace) {
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

		$.bindings.list[namespace] = [];
	};

	$.bindings.add = function (namespace, $binding) {
		$.bindings.list[namespace].push($binding);
	};
}(jQuery));