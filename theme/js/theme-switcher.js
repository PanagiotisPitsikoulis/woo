/**
 * Theme Switcher Script
 */
(($) => {
	$(document).ready(() => {
		// Theme switcher functionality
		$(".theme-item").on("click", function (e) {
			e.preventDefault();
			const theme = $(this).data("theme");

			// Update data-theme attribute immediately
			$("html").attr("data-theme", theme);

			// Store theme preference in cookie for 30 days
			const date = new Date();
			date.setTime(date.getTime() + 30 * 24 * 60 * 60 * 1000);
			document.cookie = `tw_theme=${theme}; expires=${date.toUTCString()}; path=/`;

			// Update active status in menu
			$(".theme-item").each(function () {
				const $item = $(this);
				const $svg = $item.find("svg");

				if ($item.data("theme") === theme) {
					if ($svg.length === 0) {
						$item.append(
							'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>',
						);
					}
				} else {
					$svg.remove();
				}
			});

			// Send AJAX request to save if user is logged in
			$.ajax({
				url: twTheme.ajaxUrl,
				type: "POST",
				data: {
					action: "tw_save_theme",
					theme: theme,
					nonce: twTheme.nonce,
				},
				success: (response) => {
					console.log("Theme preference saved");
				},
			});
		});

		// Check for theme cookie on page load
		function getCookie(name) {
			const value = `; ${document.cookie}`;
			const parts = value.split(`; ${name}=`);
			if (parts.length === 2) return parts.pop().split(";").shift();
		}

		const cookieTheme = getCookie("tw_theme");
		if (cookieTheme) {
			$("html").attr("data-theme", cookieTheme);
		}
	});
})(jQuery);
