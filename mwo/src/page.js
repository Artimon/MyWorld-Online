

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
}(jQuery));