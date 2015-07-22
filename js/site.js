var buttonUp = false;

jQuery(document).ready(function($) {
	$(window).scroll(function() {
		var scrollTo = $(window).scrollTop();
		var docHeight = $(document).height();
		var windowHeight = $(window).height();
		scrollPercent = (scrollTo / (docHeight - windowHeight)) * 100;
		if (!buttonUp && scrollPercent >= 10) {
			$('.button-up').show();
			buttonUp = true;
		};
		if (scrollPercent < 10) {
			$('.button-up').hide();
			buttonUp = false;
		};
	});

	$('.button-up').click(function() {
		$(document.body).animate({scrollTop: $(".site-header").offset().top}, 1000);
	})
});