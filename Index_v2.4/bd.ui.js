(function ($) {

	$(document).ready(function () {

		$('.demo').each(function () {

			var tabs = $(this).find('.tabs a'),
					panels = $(this).find('.panel').hide(),
					hash = window.location.hash;

			$(this).find('.tabs a:first').addClass('active');
			$(this).find('.panel:first').show();

			tabs.click(function () {
				var active = $(this).attr("href");

				// Toggle active class
				tabs.parent().removeClass('active');
				$(this).parent().addClass('active');

				// Toggle selected panel
				panels.hide();
				$(active).show();

				// Prevent default behavior
				return false;
			});

		});

		var nav = $('.nav'),
				footer = $('.footer');
		
	});

})(jQuery);