$.fn.extend({
    animateCss: function (animationName, callBack) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
            callBack();
        });
        return this;
    }
});

(function($) {

	"use strict";

	$('.carousel').carousel({
		interval: false
	});

	// jQuery Stick menu
	$(".navbar").sticky({
		topSpacing: 0,
	});


	$('.nav').singlePageNav({
        currentClass : 'current'
    });


    //Click event to scroll to top
	$('#scroll-to-content').on('click', function(e){
		e.preventDefault();

		$('html,body').animate({
			scrollTop: $('.first-section').offset().top-70
        }, 600);
	});


	//Click event to scroll to top
	$('.go-top').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});

	$('.navbar-nav a').click(function(){
		if($('.navbar-header .navbar-toggle').css('display') !='none'){
            $(".navbar-header .navbar-toggle").trigger( "click" );
        }
	});

	$('[data-scroll-top]').click(function(e){
		e.preventDefault();
		e.stopPropagation();

		$('html,body').animate({
			scrollTop: $('.first-section').offset().top-60
        }, 600);
	});

	setTimeout(
		function(){
			$('[data-flash]').animateCss('fadeOutRight', function(){
				$('[data-flash]').remove();
			});
		},
	4000);

})(jQuery);
