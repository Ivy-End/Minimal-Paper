var buttonUp = false;

jQuery(document).ready(function($) {
	$(window).scroll(function() {
		if (!buttonUp && $(window).scrollTop() >= 1200) {
			$('.button-up').show();
			buttonUp = true;
		};
		if ($(window).scrollTop() < 1200) {
			$('.button-up').hide();
			buttonUp = false;
		};
	});

	$('.button-up').click(function() {
		$(document.body).animate({scrollTop: $(".site-header").offset().top}, 1000);
	})
});