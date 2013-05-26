

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
}(jQuery));