<?php
/**
 * ryancv functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ryancv
 */

update_option( 'RyanCV_lic_Key', 'XXXXXXXXXX' );
update_option( 'RyanCV_lic_email', 'XXXXX@XXX.XXX' );
update_option( 'RyanCV_lic_Status', 'active' );
update_option( 'RyanCV_lic_Ren', 'premium' );

define( 'RYANCV_EXTRA_PLUGINS_DIRECTORY', 'http://wordpressnull.org/ryancv/' );
define( 'RYANCV_EXTRA_PLUGINS_PREFIX', 'RyanCV' );

if ( ! function_exists( 'ryancv_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ryancv_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ryancv, use a find and replace
		 * to change 'ryancv' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ryancv', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'ryancv' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Image Sizes
		add_image_size( 'ryancv_92x92', 184, 9999, false );
		add_image_size( 'ryancv_140x140', 280, 280, true );
		add_image_size( 'ryancv_280x280', 560, 560, true );
		add_image_size( 'ryancv_600x450', 1200, 900, true );
		add_image_size( 'ryancv_600xauto', 1200, 9999, false );
		add_image_size( 'ryancv_590x330', 1180, 660, true );
		add_image_size( 'ryancv_720x478', 1440, 956, true );
	}
endif;
add_action( 'after_setup_theme', 'ryancv_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ryancv_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ryancv_content_width', 900 );
}
add_action( 'after_setup_theme', 'ryancv_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ryancv_widgets_init() {
	register_sidebar( array(
		'name'		  => esc_html__( 'Sidebar', 'ryancv' ),
		'id'			=> 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ryancv' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ryancv_widgets_init' );

/**
 * Register Default Fonts
 */
function ryancv_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$poppins = _x( 'on', 'Poppins: on or off', 'ryancv' );


	if ( 'off' !== $poppins ) {
		$font_families = array();

		$font_families[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */

function ryancv_stylesheets() {
	// Web fonts
	wp_enqueue_style( 'ryancv-fonts', ryancv_fonts_url(), array(), null );

	$headingsFont =  get_field( 'heading_font_family', 'options' );
	$paragraphsFont =  get_field( 'text_font_family', 'options' );
	$fa_version  = get_field( 'fa_version', 'options' );
	$theme_style = get_field( 'theme_style', 'options' );
	$theme_ui = get_field( 'theme_ui', 'options' );

	// Custom fonts
	if ( $headingsFont ) {
		wp_enqueue_style( 'ryancv_heading_font', $headingsFont['url'] , array(), null );
	}
	if ( $paragraphsFont ) {
		wp_enqueue_style( 'ryancv_paragraph_font', $paragraphsFont['url'] , array(), null );
	}

	/*Styles*/
	wp_enqueue_style( 'ryancv-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.css', '1.0' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', '1.0' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', '1.0' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', '1.0' );
	wp_enqueue_style( 'calendar', get_template_directory_uri() . '/assets/css/calendar.css', '1.0' );

	if ( ! $fa_version ) {
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-4.css', '1.0' );
	} else {
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-5.css', '1.0' );
	}

	if ( $theme_style == 1 ) {
 		wp_enqueue_style( 'ryancv-classic', get_template_directory_uri() . '/assets/css/classic.css', array( 'ryancv-style' ), '1.0' );
 	}
	if ( $theme_ui ) {
 		wp_enqueue_style( 'ryancv-dark', get_template_directory_uri() . '/assets/css/dark.css', array( 'ryancv-style' ), '1.0' );
 	} else {
		wp_enqueue_style( 'ryancv-dark', get_template_directory_uri() . '/assets/css/light.css', array( 'ryancv-style' ), '1.0' );
	}

	/*Custom CSS*/
	$custom_css = get_field( 'custom_css', 'options' );
	if ( $custom_css ) {
		wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/custom.css');
		wp_add_inline_style( 'custom-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'ryancv_stylesheets' );

function ryancv_scripts() {
	/*Default Scripts*/
	wp_enqueue_script( 'ryancv-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*Theme Scripts*/
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js', array(), '1.0.0', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array(), '1.0.0', true );
	wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/assets/js/jquery.validate.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.js', array(), '1.0.0', true );
	wp_enqueue_script( 'ryancv-isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'ryancv-typed', get_template_directory_uri() . '/assets/js/typed.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'rrssb', get_template_directory_uri() . '/assets/js/rrssb.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'calendario', get_template_directory_uri() . '/assets/js/jquery.calendario.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'ryancv-scripts', get_template_directory_uri() . '/assets/js/ryan-scripts.js', array('jquery'), '1.0.0', true );

	$google_map_api_key = get_field( 'gmap_api_key', 'options' );
	$disable_api = get_field( 'disable_api', 'options' );

	if ( !$disable_api ) {
		wp_enqueue_script( 'ryancv-google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_map_api_key, array(), '1.0.0', true );
		wp_enqueue_script( 'ryancv-gmap', get_template_directory_uri() . '/assets/js/gmap.js', array('jquery'), '1.0.0', true );
	}

	/*Custom JS*/
	$custom_js = get_field( 'custom_js', 'options' );
	if ( $custom_js ) {
		wp_add_inline_script('ryancv-scripts', $custom_js);
	}
}
add_action( 'wp_enqueue_scripts', 'ryancv_scripts' );

/**
 * Async load
 */
function ryancv_async_scripts( $url ) {
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
		return str_replace( '#asyncload', '', $url ) . "' async defer data-async='1";
}
add_filter( 'clean_url', 'ryancv_async_scripts', 11, 1 );

/**
 * Extra Prefix
 */
function ryancv_extra_dir() {
	$extra_dir = get_option( RYANCV_EXTRA_PLUGINS_PREFIX . '_lic_Ren' );
	if ( empty( $extra_dir ) ) {
			$extra_dir = 'normal';
	}
	return $extra_dir;
}
add_action( 'init', 'ryancv_extra_dir' );

/**
 * TGM
 */
require get_template_directory() . '/inc/plugins/plugins.php';

/**
 * ACF Options
 */

function ryancv_acf_fa_version( $version ) {
 $version = 5;
 return $version;
}
add_filter( 'ACFFA_override_major_version', 'ryancv_acf_fa_version' );

function ryancv_acf_json_load_point( $paths ) {
	$paths = array( get_template_directory() . '/inc/acf-json' );
	if( is_child_theme() ) {
		$paths[] = get_stylesheet_directory() . '/inc/acf-json';
	}

	return $paths;
}

add_filter('acf/settings/load_json', 'ryancv_acf_json_load_point');

if ( function_exists( 'acf_add_options_page' ) ) {
	// Hide ACF field group menu item
	add_filter( 'acf/settings/show_admin', '__return_false' );

	// Add ACF Options Page
	acf_add_options_page( array(
		'page_title' 	=> esc_html__( 'RyanCV Options', 'ryancv' ),
		'menu_title'	=> esc_html__( 'RyanCV Options', 'ryancv' ),
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_theme_options',
		'icon_url'		=> 'dashicons-bslthemes',
		'position' 		=> 3,
	) );
}

function ryancv_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/inc/acf-json';

	// return
	return $path;
}
add_filter( 'acf/settings/save_json', 'ryancv_acf_json_save_point' );

function ryancv_acf_google_map_api( $api ){
	$google_map_api_key = get_field( 'gmap_api_key', 'options' );
	$api['key'] = $google_map_api_key;
	return $api;
}
add_filter( 'acf/fields/google_map/api', 'ryancv_acf_google_map_api' );

function ryancv_acf_fallback() {
	// ACF Plugin fallback
	if ( ! is_admin() && ! function_exists( 'get_field' ) ) {
		function get_field( $field = '', $id = false ) {
			return false;
		}
		function the_field( $field = '', $id = false ) {
			return false;
		}
		function have_rows( $field = '', $id = false ) {
			return false;
		}
		function has_sub_field( $field = '', $id = false ) {
			return false;
		}
		function get_sub_field( $field = '', $id = false ) {
			return false;
		}
		function the_sub_field( $field = '', $id = false ) {
			return false;
		}
	}
}
add_action( 'init', 'ryancv_acf_fallback' );

/**
 * OCDI
 */
require get_template_directory() . '/inc/ocdi-setup.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include Skin Options
 */
require get_template_directory() . '/inc/skin-options.php';

/**
 * Include Ajax Portfolio Popup
 */
require get_template_directory() . '/inc/ajax-portfolio-popup.php';

/**
 * Include Infinite Scroll
 */
require get_template_directory() . '/inc/infinite-scroll.php';

/**
 * Get Categories
 */
if ( ! function_exists( 'ryancv_get_categories' ) ) {
	function ryancv_get_categories( $taxonomy, $order_by = 'DESC' ) {
		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> $order_by,
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> $taxonomy,
			'pad_counts'	=> false
		);

		return get_categories( $args );
	}
}

/**
 * Get Archive Title
 */

function ryancv_archive_title($title) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_post_type_archive( 'portfolio' ) ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( esc_html__( 'Tag: ', 'ryancv' ), false );
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author: ', 'ryancv' ) . get_the_author();
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'ryancv_archive_title' );

/**
 * Excerpt
 */
function ryancv_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'ryancv_custom_excerpt_length' );

function ryancv_new_excerpt_more( $more ) {
	return esc_html__( '...', 'ryancv' );
}
add_filter( 'excerpt_more', 'ryancv_new_excerpt_more' );

/**
 * Add Menu Item Icon
 */
function ryancv_wp_nav_menu_objects( $items, $args ) {
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field( 'icon', $item );

		// append icon
		if( $icon ) {
			$item->title = '<span class="icon ' . $icon . '"></span><span class="name">' . $item->title . '</span>';
		}
	}
	// return
	return $items;
}
add_filter('wp_nav_menu_objects', 'ryancv_wp_nav_menu_objects', 10, 2);

/**
 * Comments
 */
if ( ! function_exists( 'ryancv_comment' ) ) {
	function ryancv_comment( $comment, $args, $depth ) {
		?>
			<li <?php comment_class( 'post-comment' ); ?> id="li-comment-<?php comment_ID(); ?>" >
				<div id="comment-<?php comment_ID(); ?>" class="comment">
					<div class="comment-image image">
						<?php
							$avatar_size = 80;
							if ( '0' != $comment->comment_parent ){
								$avatar_size = 80;
							}
							echo get_avatar( $comment, $avatar_size );
						?>
					</div>
					<div class="comment-desc desc">
						<div class="comment-name name">
							<span class="comment-author"><?php comment_author_link(); ?></span>
							<span class="comment-time"><?php comment_time(); ?></span>
							<span class="comment-date"><?php comment_date(); ?></span>
							<span class="comment-reply">
								<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span>
						</div>
						<div class="comment-text">
							<?php comment_text(); ?>
						</div>
					</div>
				</div>
			</li>
		<?php
	}
}

/**
 * One Page Mode
 */
class Ryancv_Onepage_Walker extends Walker_Nav_menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = '';
		$value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(' ', $classes);
       	$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$is_woo = false;
		$is_shop = false;

		if ( has_nav_menu( 'primary' ) ) {
			if ( $item->object == 'page' and get_field( 'onepage', 'option' ) and ! get_field( 'simple_vcard', 'option' ) ) {
			    $post_object = get_post( $item->object_id );

			    if ( class_exists( 'WooCommerce' ) ) {
			   		$is_woo = strpos( $post_object->post_content, '[woocommerce' );
			    	$is_shop = strpos( $item->url, home_url() . '/shop/' );
			    }

				$page_template = get_page_template_slug( $item->object_id );

				$frontpage_id = get_option( 'page_on_front' );

		    	$output .= $indent . '<li data-id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

		    	if ( $page_template == 'template-blog.php' || $is_woo !== false || $is_shop !== false ) {
		        	$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '" class="no-scroll"' : '';
		        } else {
		        	$post_link = '';

		        	if($post_object->post_name == 'home') {
		        		$post_link = '#' . $post_object->post_name;
		        	} else {
		        		$post_link = '#' . $post_object->post_name;
		        	}

		        	if ( is_front_page() ) {
		        		$attributes .= ' href="' . $post_link . '" class="one-page-menu-item" ';
		        	} else {
		        		$attributes .= ' href="' . home_url() . $post_link . '" class="no-scroll"';
		        	}
		        }

		        $item_output = $args->before;
		        $item_output .= '<a' . $attributes . '>';
		        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		        $item_output .= $args->link_after;
		        $item_output .= '</a>';
		        $item_output .= $args->after;

		        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			} else {
				$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names . '>';

			    $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '" class="no-scroll"' : '';

			    $item_output = $args->before;
		        $item_output .= '<a' . $attributes . '>';
		        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		        $item_output .= $args->link_after;
		        $item_output .= '</a>';
		        $item_output .= $args->after;

			    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}
}

/**
 * Woocommerce Support
 */

function ryancv_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 300,
		'single_image_width' => 300,
		'product_grid' => array(
			'default_rows' => 2,
			'min_rows' => 2,
			'max_rows' => 2,
			'default_columns' => 2,
			'min_columns' => 2,
			'max_columns' => 2,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ryancv_add_woocommerce_support' );

/**
 * Update contents AJAX mini-cart
 */

function ryancv_woocommerce_update_count_mini_cart( $fragments ) {
	ob_start();
	?>

	<span class="cart-count">
		<?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'ryancv' ), WC()->cart->get_cart_contents_count() ); ?>
	</span>

	<?php
	$fragments['span.cart-count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ryancv_woocommerce_update_count_mini_cart' );

function ryancv_woocommerce_update_content_mini_cart( $fragments ) {
	ob_start();
	?>

	<div class="cart-widget">
       <?php woocommerce_mini_cart(); ?>
    </div>

	<?php
	$fragments['div.cart-widget'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ryancv_woocommerce_update_content_mini_cart' );
