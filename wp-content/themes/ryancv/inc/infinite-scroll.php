<?php
/**
 * Ajax Infinite Scroll for Portfolio & Posts
 */

function ryancv_ajax_infinite_scroll_el() {
	$post_type = $_POST['post_type'];

	if ( $post_type == 'portfolio' ) {
		//load portfolio posts

		$page_id = $_POST['page_id'];
		$paged = $_POST['page_no'];
			
		$orderby = $_POST['order_by'];
		$per_page = $_POST['per_page'];
		$order = $_POST['order'];
		$source = $_POST['source'];
		$temp = $_POST['temp'];
		$cat_ids = $_POST['cat_ids'];
		$cat_ids = explode(",", $cat_ids);

		$args = array(
			'post_type'		 => 'portfolio',
			'post_status'	   => 'publish',
			'orderby'			=> $orderby,
			'order'				=> $order,
			'posts_per_page'	=> $per_page,
			'paged' 			=> $paged
		);

		if( $source == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new WP_Query($args);
		
		if( $q->have_posts() ) :
			while( $q->have_posts() ) : $q->the_post();
				get_template_part( 'template-parts/content-' . $temp );
			endwhile;

			wp_reset_postdata();
		endif;

		exit;

	} else {
		//load blog posts

		$page_id = $_POST['page_id'];
		$paged = $_POST['page_no'];
			
		$orderby = $_POST['order_by'];
		$per_page = $_POST['per_page'];
		$order = $_POST['order'];
		$source = $_POST['source'];
		$temp = $_POST['temp'];
		$cat_ids = $_POST['cat_ids'];

		$args = array(
			'post_type'		 => 'post',
			'post_status'	   => 'publish',
			'orderby'			=> $orderby,
			'order'				=> $order,
			'posts_per_page'	=> $per_page,
			'paged' 			=> $paged
		);

		if( $source == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new WP_Query($args);
		
		if( $q->have_posts() ) :
			while( $q->have_posts() ) : $q->the_post();
				get_template_part( 'template-parts/content', $temp );
			endwhile;

			wp_reset_postdata();
		endif;

		exit;

	}
}
add_action( 'wp_ajax_infinite_scroll_el', 'ryancv_ajax_infinite_scroll_el' );
add_action( 'wp_ajax_nopriv_infinite_scroll_el', 'ryancv_ajax_infinite_scroll_el' );