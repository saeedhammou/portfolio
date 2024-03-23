(function ($) {
	"use strict";

	/* Init Elementor Front Scripts */
	$(window).on('elementor/frontend/init', function () {

		// Widgets
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ryancv-testimonials.default', function() {

		} );

		elementorFrontend.hooks.addAction( 'frontend/element_ready/ryancv-skills.default', function() {
			/*
				Dotted Skills Line
			*/

			function skills(){
				var skills_dotted = $('.elementor-editor-active .skills-list.dotted .progress');
				var skills_dotted_w = skills_dotted.width();
				if(skills_dotted.length){
					skills_dotted.append('<span class="dg"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>');
					skills_dotted.find('.percentage').append('<span class="da"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>');
					skills_dotted.find('.percentage .da').css({'width':skills_dotted_w});
				}
			}
			setTimeout(skills, 1000);

			/*
				Circle Skills Line
			*/

			var skills_circles = $('.elementor-editor-active .skills-list.circles .progress');
			if(skills_circles.length){
				skills_circles.append('<div class="slice"><div class="bar"></div><div class="fill"></div></div>');
			}
		} );

		// Global
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {

		} );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ) {

		} );
	});
})(jQuery);
