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
		$('html, body').animate({scrollTop: $(".site-header").offset().top}, 1000);
	});

	// 评论分页
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $ ('html,body');
	
	// 点击分页导航链接时触发分页
	$('.comment-navigation div a').live('click', function(e){
	    e.preventDefault();
	    $.ajax({
	        type: "GET",
	        url: $(this).attr('href'),
	        beforeSend: function(){
	            $('.comment-navigation').remove();
	            $('.comment-list').remove();
	            $('#comment-loading').show();
	            $body.animate({scrollTop: $('.comments-title').offset().top - 65}, 800 );
	        },
	        dataType: "html",
	        success: function(out){
	            result = $(out).find('.comment-list');
	            nextlinkabove = $(out).find('#comment-nav-above');
	            nextlinkbelow = $(out).find('#comment-nav-below');
	            $('#comment-loading').hide();
	            $('.comments-title').after(nextlinkabove);
	            $('#comment-loading').after(result.fadeIn(500));
	            $('.comment-list').after(nextlinkbelow);
	        }
	    });
	});

});