<?php
/**
 * Template part for displaying portfolio item
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ryancv
 */

?>

<?php
	/* options */
	$portfolio_single = get_field( 'portfolio_single', 'options' );
	$portfolio_qv = get_field( 'portfolio_qv', 'options' );
	$popup_elementor = get_field( 'popup_elementor', 'options' );

	/* post content */
	$current_categories = get_the_terms( get_the_ID(), 'portfolio_categories' );
	$category = '';
	$category_slug = '';
	if ( $current_categories && ! is_wp_error( $current_categories ) ) {
		$arr_keys = array_keys( $current_categories );
		$last_key = end( $arr_keys );
		foreach ( $current_categories as $key => $value ) {
			if ( $key == $last_key ) {
				$category .= $value->name . ' ';
			} else {
				$category .= $value->name . ', ';
			}
			$category_slug .= 'f-' . $value->slug . ' ';
		}
	}
	$id = get_the_ID();
	$title = get_the_title();
	$href = get_the_permalink();

	/*get portfolio type*/
	$type = get_field( 'portfolio_type', $id );
	$popup_url = get_the_post_thumbnail_url( $id, 'full' );
	if ($popup_elementor == 1) {
	$popup_class = 'has-popup-image';
	} else {
	$popup_class = '';
	}
	$preview_icon = 'fas fa-image';
	$images = false;
	$popup_link_target = false;

	if ( $type == 2 ) {
		$popup_url = get_field( 'music_url', $id );
		$popup_class = 'has-popup-music';
		$preview_icon = 'fas fa-music';
	} elseif ( $type == 3 ) {
		$popup_url = get_field( 'video_url', $id );
		$popup_class = 'has-popup-video';
		$preview_icon = 'fas fa-video';
	} elseif ( $type == 4 ) {
		$popup_url = '#popup-' . $id;
		$popup_class = 'has-popup-media';
		$preview_icon = 'fas fa-plus';
		$btn_text = get_field( 'button_text', $id );
		if(empty($btn_text)){
			$btn_text = esc_html__( 'View Project', 'ryancv' );
		}
		$btn_url = get_field( 'button_url', $id );
	} elseif ( $type == 5 ) {
		if ($popup_elementor == 1) {
		$popup_url = '#gallery-' . $id;
		$popup_class = 'has-popup-gallery';
		} else {
		$popup_url = get_the_post_thumbnail_url( $id, 'full' );
		$popup_class = '';
		}
		$preview_icon = 'fas fa-images';
		$images = get_field( 'gallery', $id );
	} elseif ( $type == 6 ) {
		$popup_url = get_field( 'link_url', $id );
		$popup_link_target = true;
		$popup_class = 'has-popup-link';
		$preview_icon = 'fas fa-link';
	} else { }

?>

<!-- work item -->
<div class="col col-d-6 col-t-6 col-m-12 border-line-h grid-item <?php echo esc_attr( $category_slug ); ?>">
	<div class="box-item">
		<div class="image">
			<?php if ( $portfolio_qv ) : ?>
				<?php if ( $portfolio_single ) : ?>
					<a>
						<?php if ( has_post_thumbnail( $id ) ) : 
							echo get_the_post_thumbnail( $id, 'ryancv_600xauto' );
						endif; ?>
						<span class="info">
							<span class="ion"></span>
						</span>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( get_the_permalink( $id ) ); ?>">
						<?php if ( has_post_thumbnail( $id ) ) : 
							echo get_the_post_thumbnail( $id, 'ryancv_600xauto' );
						endif; ?>
						<span class="info">
							<span class="ion ion-ios-book-outline"></span>
						</span>
					</a>
				<?php endif; ?>
			<?php else : ?>
				<a href="<?php echo esc_url( $popup_url ); ?>" class="<?php echo esc_attr( $popup_class ); ?>"<?php if ( $popup_link_target ) : ?> target="_blank"<?php endif; ?><?php if ( $popup_elementor == 0 ) : ?> data-elementor-lightbox-title="<?php echo esc_attr( $title ); ?>" data-elementor-lightbox-slideshow="gallery-<?php echo esc_attr( $id ); ?>"<?php endif; ?>>
					<?php if ( has_post_thumbnail( $id ) ) : 
						echo get_the_post_thumbnail( $id, 'ryancv_600xauto' );
					endif; ?>
					<span class="info">
						<span class="ion <?php echo esc_attr( $preview_icon ); ?>"></span>
					</span>
				</a>
				<?php if( $images ) : ?>
					<div id="gallery-<?php echo esc_attr( $id ); ?>" class="mfp-hide">
						<?php foreach( $images as $image ): ?>
						<?php $gallery_img_src = wp_get_attachment_image_src( $image['ID'], 'full' ); ?>
						<a href="<?php echo esc_url( $gallery_img_src[0] ); ?>"<?php if ( $popup_elementor == 0 ) : ?> data-elementor-lightbox-slideshow="gallery-<?php echo esc_attr( $id ); ?>" data-elementor-lightbox-title="<?php echo esc_attr( $title ); ?>"<?php endif; ?>></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="desc">
			<?php if ( $portfolio_single ) : ?>
				<?php if ( $portfolio_qv ) : ?>
					<a class="name"><?php echo esc_html( $title ); ?></a>
				<?php else : ?>
					<a href="<?php echo esc_url( $popup_url ); ?>" class="name <?php echo esc_attr( $popup_class ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php endif; ?>	
			<?php else : ?>
				<a href="<?php echo esc_url( $href ); ?>" class="name"><?php echo esc_html( $title ); ?></a>
			<?php endif; ?>

			<?php if ( $category ) : ?>
				<div class="category"><?php echo esc_html( $category ); ?></div>
			<?php endif; ?>
		</div>

		<?php if ( $type == 4 ) : ?>
		<div id="popup-<?php echo esc_attr( $id ); ?>" class="popup-box mfp-fade mfp-hide">
			<div class="content">
				<div class="preloader-popup">
					<div class="centrize full-width">
						<div class="vertical-center">
							<div class="spinner default-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>