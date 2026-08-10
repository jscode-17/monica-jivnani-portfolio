
(function ($) {
	"use strict";


	// dark light mode toggler
	function tp_theme_toggler() {

		$('.themepure-theme-toggle-input').on("change", function () {
			toggleTheme();
		});

		var themeMode = $("html").attr('data-theme-mode');


		// set toggle theme scheme
		function tp_set_scheme(tp_theme) {
			$("html").attr("data-theme-mode", tp_theme);
		}

		// toogle theme scheme
		function toggleTheme() {
			var updatedThemeMode = $("html").attr('data-theme-mode');

			if (updatedThemeMode === 'dark_mode') {
				tp_set_scheme('light_mode');
                $('.themepure-theme-toggle').removeClass('dark-active').addClass('light-active');
			} else {
				tp_set_scheme('dark_mode');
                $('.themepure-theme-toggle').removeClass('light-active').addClass('dark-active');
			}
		}

		// set the first theme scheme
		function tp_init_theme() {

			if (themeMode === 'light_mode') {
				
                tp_set_scheme('light_mode');
                $('.themepure-theme-toggle').removeClass('dark-active').addClass('light-active');
				document.getElementsByClassName('tp-theme-toggler').checked = false;

			} else {
				tp_set_scheme('dark_mode');
				document.getElementsByClassName('tp-theme-toggler').checked = true;
                $('.themepure-theme-toggle').removeClass('light-active').addClass('dark-active');
			}
		}
		tp_init_theme();
	}
	if ($(".themepure-theme-toggle-input").length > 0) {
		tp_theme_toggler();
	}

})(jQuery);