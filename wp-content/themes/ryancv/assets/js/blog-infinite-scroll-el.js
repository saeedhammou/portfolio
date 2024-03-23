( function( $ ) {
	"use strict";
	
	var blog_count = 2;
	var blog_total = ajax_blog_infinite_scroll_data.max_num;
	var blog_flag = 1;
	var blog_wrap = $('.blog-grid').closest('.card-inner').find('.card-wrap');
	var blog_items = $('.blog-grid .grid-items');

	blog_wrap.on('scroll', function(){
		if ( blog_wrap.closest('.card-inner').hasClass('active') ){
		    if ( blog_wrap.scrollTop() + blog_wrap.height() >= blog_items.offset().top + blog_items.height() ) {
		        if ( blog_count > blog_total ) {
		            return false;
		        } else {
		        	if( blog_flag == 1 ){
		            	blog_loadContent(blog_count);
		            }
		        }
		        if( blog_flag == 1 ){
		        	blog_flag = 0;
		        	blog_count++;
		        }
		    }
		}
	});

	function blog_loadContent(pageNumber) {
	    $.ajax({
	        url: ajax_blog_infinite_scroll_data.url,
	        type:'POST',
	        data: "action=infinite_scroll_el&page_no="+ pageNumber + '&post_type=post' + '&page_id=' + ajax_blog_infinite_scroll_data.page_id + '&order_by=' + ajax_blog_infinite_scroll_data.order_by + '&order=' + ajax_blog_infinite_scroll_data.order + '&per_page=' + ajax_blog_infinite_scroll_data.per_page + '&source=' + ajax_blog_infinite_scroll_data.source + '&temp=' + ajax_blog_infinite_scroll_data.temp + '&cat_ids=' + ajax_blog_infinite_scroll_data.cat_ids,
	        success: function(html){
	            var $html = $(html);
	            var $container = blog_items;

	            $container.find('> .clear').remove();
	            $container.append($html);
	            $container.append('<div class="clear"></div>');

				$html.imagesLoaded(function(){
					$container.append($html);
					$container.isotope('appended', $html );
					$container.isotope('layout');
				});

	            blog_flag = 1;
	        }
	    });
	    return false;
	}
} )( jQuery );