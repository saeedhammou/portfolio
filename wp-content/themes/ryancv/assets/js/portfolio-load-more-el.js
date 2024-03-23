( function( $ ) {
	"use strict";
	
	var count = 2;
	var total = ajax_portfolio_infinite_scroll_data.max_num;
	var flag = 1;
	var works = $('.works-grid .grid-items');

	$('.works-grid .load-more').on( 'click', function(){
		if ( $('.active .works-grid .grid-items').length ) {
        	works = $('.active .works-grid .grid-items');
		}
		if ( count > total ) {
            $(this).closest('.bts').hide();
        } else {
        	if( flag == 1 ){
            	loadContent(count);

            	if ( count + 1 > total ) {
            		$(this).closest('.bts').fadeOut(500);
            	}
            }
        }
        if( flag == 1 ){
        	flag = 0;
        	count++;
        }

        return false;
	});

	function loadContent(pageNumber) {
	    $.ajax({
	        url: ajax_portfolio_infinite_scroll_data.url,
	        type:'POST',
	        data: "action=infinite_scroll_el&page_no="+ pageNumber + '&post_type=portfolio' + '&page_id=' + ajax_portfolio_infinite_scroll_data.page_id + '&order_by=' + ajax_portfolio_infinite_scroll_data.order_by + '&order=' + ajax_portfolio_infinite_scroll_data.order + '&per_page=' + ajax_portfolio_infinite_scroll_data.per_page + '&source=' + ajax_portfolio_infinite_scroll_data.source + '&temp=' + ajax_portfolio_infinite_scroll_data.temp + '&cat_ids=' + ajax_portfolio_infinite_scroll_data.cat_ids,
	        success: function(html){
	            var $html = $(html);
	            var $container = works;

	            $html.imagesLoaded(function(){
					$container.append($html);
					$container.isotope('appended', $html );
					$container.isotope('layout');

					updateMagnificPopups();
				});

	            flag = 1;
	        }
	    });
	    return false;
	}

	function updateMagnificPopups() {
		/* popup image */
		$('.has-popup-image').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			mainClass: 'popup-box',
			image: {
				verticalFit: true
			}
		});
		
		/* popup video */
		$('.has-popup-video').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			preloader: false,
			fixedContentPos: false,
			mainClass: 'popup-box',
			callbacks: {
				markupParse: function(template, values, item) {
					template.find('iframe').attr('allow', 'autoplay');
				}
			}
		});
		
		/* popup music */
		$('.has-popup-music').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			preloader: false,
			fixedContentPos: false,
			mainClass: 'popup-box',
			callbacks: {
				markupParse: function(template, values, item) {
					template.find('iframe').attr('allow', 'autoplay');
				}
			}
		});

		/* popup gallery */
		$('.has-popup-gallery').on('click', function() {
	        var gallery = $(this).attr('href');
	    
	        $(gallery).magnificPopup({
	            delegate: 'a',
	            type:'image',
	            closeOnContentClick: false,
	            mainClass: 'mfp-fade',
	            removalDelay: 160,
	            fixedContentPos: false,
	            gallery: {
	                enabled: true
	            }
	        }).magnificPopup('open');

	        return false;
	    });

		/* popup media */
		$('.has-popup-media').magnificPopup({
		    type: 'inline',
		    overflowY: 'auto',
		    closeBtnInside: true,
		    mainClass: 'popup-box-inline',
		    callbacks : {
		        elementParse: function(item) {
		            // Function will fire for each target element
		            // "item.el" is a target DOM element (if present)
		            // "item.src" is a source that you may modify

		            var item_id = item.src.replace('#popup-', '');

		            $.ajax({
		                url: portfolio_ajax_loading_data.url,
		                type: 'POST',
		                data: 'action=portfolio_popup&post_id=' + item_id,
		                success: function(html){
		                    $(item.src+' .content').html(html);
		                }
		            });
		        },
		        open : function(){
		           
		        }
		    }
		});
	}
} )( jQuery );