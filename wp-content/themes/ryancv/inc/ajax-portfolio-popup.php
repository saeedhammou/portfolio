<?php
/**
 * Ajax Load Scripts
 */

function ryancv_ajax_portfolio_content_scripts() {
	$data = array(
		'url'   => admin_url( 'admin-ajax.php' ),
	);

	if ( !empty( $data ) ) {
		wp_enqueue_script( 'ajax-portfolio-content', get_template_directory_uri() . '/assets/js/ajax-portfolio-content.js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'ajax-portfolio-content', 'portfolio_ajax_loading_data', $data );
	}
}
add_action( 'wp_enqueue_scripts', 'ryancv_ajax_portfolio_content_scripts' );

/**
 * Ajax Loading
 */
function ryancv_ajax_portfolio_content() {
	$post_id = $_POST['post_id'];

	/*get categories*/
	$current_categories = get_the_terms( $post_id, 'portfolio_categories' );
	$categories_string = '';
	$categories_slugs_string = '';
	if ( $current_categories && ! is_wp_error( $current_categories ) ) {
		$arr_keys = array_keys( $current_categories );
		$last_key = end( $arr_keys );
		foreach ( $current_categories as $key => $value ) {
			if ( $key == $last_key ) {
				$categories_string .= $value->name . ' ';
			} else {
				$categories_string .= $value->name . ', ';
			}
			$categories_slugs_string .= 'f-' . $value->slug . ' ';
		}
	}

	/*get content*/
	$title = get_the_title( $post_id );
	$info = get_field( 'info', $post_id );
	$btn_url = get_field( 'button_url', $post_id );

	?>

	<div class="image">
		<?php if ( has_post_thumbnail( $post_id ) ) :
			echo get_the_post_thumbnail( $post_id, 'ryancv_720x478' );
		endif; ?>
	</div>
	<div class="desc">
		<div class="post-box">
			<h2 class="h-title"><?php echo esc_html( $title ); ?></h2>
			<?php if ( $categories_string ) : ?>
			<div class="blog-detail"><?php echo esc_html( $categories_string ); ?></div>
			<?php endif; ?>
			<?php if ( $info ) : ?>
			<div class="info-list">
				<ul>
					<?php foreach ( $info as $item ) { ?>
					<li><strong><?php echo esc_html( $item['label'] ); ?><?php echo esc_html__( ':', 'ryancv' ); ?></strong> <?php echo esc_html( $item['value'] ); ?></li>
					<?php } ?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="blog-content">
				<?php
				if ( is_plugin_active( 'elementor/elementor.php' ) ) {
					echo \Elementor\plugin::instance()->frontend->get_builder_content( $post_id, true );
				} else {
					echo apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) );
				}
				?>
			</div>
			<?php if ( $btn_url ) : ?>
			<a href="<?php echo esc_url( $btn_url ); ?>" class="button">
				<span class="text"><?php echo esc_html__( 'View Project', 'ryancv' ); ?></span>
				<span class="arrow"></span>
			</a>
			<?php endif; ?>
			<?php
				$share_links = '';

				$social_share = get_field( 'social_share', 'options' );

				if ( $social_share ) {
					foreach ($social_share as $share) {
						$share_links .= '<a class="share-btn share-btn-'.$share['value'].'" title="'.esc_html__( 'Share on', 'ryancv' ).' '.$share['label'].'"><i class="ion ion-social-'.$share['value'].'"></i></a>';
					}
				}

				if ( $share_links ) {
					echo '<div class="post-text-bottom"><div class="social-share"><span>'.esc_html__( 'Share', 'ryancv' ).'</span> ' . $share_links .'</div></div>';
					?>
					<script type="text/javascript">
						jQuery(document).ready(function ($) {
							$('.social-share').rrssb({
								title: '<?php echo esc_attr( $title ); ?>',
								url: '<?php echo esc_url( get_the_permalink( $post_id ) ); ?>',
							});
						});
					</script>
					<?php
				}
			?>
		</div>
	</div>

	<?php
 	exit;
}
add_action( 'wp_ajax_portfolio_popup', 'ryancv_ajax_portfolio_content' );
add_action( 'wp_ajax_nopriv_portfolio_popup', 'ryancv_ajax_portfolio_content' );
