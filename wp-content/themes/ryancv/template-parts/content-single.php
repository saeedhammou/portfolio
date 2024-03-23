<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ryancv
 */

?>

<?php
	$blog_related = get_field( 'blog_related', 'option' );
	$blog_featured_img = get_field( 'blog_featured_img', 'option' );
	//get blog post subtitle
	$blog_post_subtitle = get_field( 'blog_post_subtitle', 'option' );
	if( ! $blog_post_subtitle ) {
		$blog_post_subtitle = esc_html__( 'Blog Post', 'ryancv' );
	}
 ?>

<!-- title -->
<div class="title"><?php echo esc_html( $blog_post_subtitle ); ?></div>

<!-- content -->
<div class="row border-line-v">
	<div class="col col-m-12 col-t-12 col-d-12">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-box single-post-text">
				
				<h1 class="h-title"><?php the_title(); ?></h1>
				
				<!-- blog detail -->					
				<div class="blog-detail">
					<span class="date"><?php the_date(); ?></span>
					<?php ryancv_entry_header(); ?>
				</div>
				
				<?php if ( has_post_thumbnail() && ! $blog_featured_img ) : ?>
				<!-- blog image -->
				<div class="blog-image">
					<?php
						the_post_thumbnail( 'full', array(
							'alt' => the_title_attribute( array(
								'echo' => false,
							)),
						) );
					?>
				</div>  
				<?php endif; ?>
				
				<!-- blog content -->
				<div class="blog-content">
					<?php 
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ryancv' ),
							'after'  => '</div>',
						) );
					?>
				</div>

				<div class="post-text-bottom">	
					<?php ryancv_entry_footer(); ?>
				</div>
				
				<?php if ( $blog_related ) : ?>
				<div class="post-latest">
					<div class="title">
						<span>
							<?php echo esc_html__( 'Related Posts', 'ryancv' ) ?>
						</span>
					</div>
					<div class="row border-line-v post-latest-items">
						<?php
							$orig_post = $post;
							global $post;
							$tags = wp_get_post_tags($post->ID);

							if ($tags) {
								$tag_ids = array();
								foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
								$args=array(
									'tag__in' => $tag_ids,
									'post__not_in' => array($post->ID),
									'posts_per_page'=>2
								);

								$my_query = new WP_Query( $args );

								while( $my_query->have_posts() ) { $my_query->the_post();
							?>

							<div class="col col-d-6 col-t-6 col-m-12 col-post-latest-col">
								<div class="box-item">
									<div class="image">
										<?php ryancv_post_thumbnail( 'blog' ); ?>
									</div>
									<div class="desc">
										<a href="<?php the_permalink() ?>" class="name"><?php the_title(); ?></a>
										<div class="text"><?php the_excerpt(__( '(more…)', 'ryancv' ) ); ?></div>
									</div>
								</div>
							</div>

						<?php }} $post = $orig_post; wp_reset_query(); ?>
					</div>
				</div>
				<?php endif; ?>

			</div>
		</div><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>