<?php

$title = get_sub_field( 'title' );
$title_seo = get_sub_field( 'title_seo' );
$products = get_sub_field( 'items' );
$button = get_sub_field( 'button' );
$section_id = get_sub_field( 'section_id' );

?>

<!--
	Products
-->
<div class="content shops woocommerce">
	
	<!-- title -->
	<<?php echo esc_attr( $title_seo ); ?> class="title <?php if ( ! $title ) : ?>no-title<?php endif; ?>"><?php if ( $title ) : ?><?php echo esc_html( $title ); ?><?php endif; ?></<?php echo esc_attr( $title_seo ); ?>>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
	<?php if ( $products ) : ?>
	<?php
		$products_ids = array();
		
		foreach ( $products as $row ) {
			$products_ids[] = $row['post']->ID;
		}

		// products loop
		$args = array(
			'post_type' => 'product',
			'post__in' => $products_ids
		);
		$products_loop = new WP_Query( $args );
	?>

	<?php if ( $products_loop->have_posts() ) : ?>
	<!-- content -->
	<ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?> row border-line-v">
		
		<?php while ( $products_loop->have_posts() ) :
			$products_loop->the_post();
			global $product;
			$product = wc_get_product( get_the_ID() );

			wc_get_template_part( 'content', 'product' );
		endwhile; ?>

		<div class="clear"></div>
	</ul>
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; wp_reset_postdata(); ?>

	<?php if ( $button ) : ?>
	<div class="bts bts-center">
		<a class="button" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( $button['target'] ) : ?> target="<?php echo esc_attr( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?></a>
	</div>
	<?php endif; ?>
</div>