<?php
/**
 * Plugin Name: RyanCV Advanced Background Plugin
 * Plugin URI: https://bslthemes.com/
 * Description: This plugin it's designed for RyanCV Theme and add advanced background options
 * Version: 1.3.0
 * Author: bslthemes
 * Author URI: https://bslthemes.com/
 * Text Domain: ryancv-advanced-background
 * Domain Path: /languages/
 * License: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Init all plugins constants
if ( ! defined( 'RYANCV_ADVANCED_BACKGROUND_PATH' ) ) {
	define( 'RYANCV_ADVANCED_BACKGROUND_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'RYANCV_ADVANCED_BACKGROUND_URI' ) ) {
	define( 'RYANCV_ADVANCED_BACKGROUND_URI', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'RYANCV_ADVANCED_BACKGROUND_SLUG' ) ) {
	define( 'RYANCV_ADVANCED_BACKGROUND_SLUG', 'RyanCV' );
}

// Main Class
if ( ! class_exists( 'RyanCVAdvancedBackground' ) ) {

	class RyanCVAdvancedBackground {

		public $theme_bg;

		public function __construct() {
		}

		public function init() {
			/*init*/
			$this->init_hooks();
			$this->init_helpers();
		}

		public function plugin_load_textdomain() {
			/* load plugin text-domain */
			load_plugin_textdomain( 'ryancv-advanced-background', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		public function init_hooks() {
			/* hooks */
			add_action( 'plugins_loaded', [$this, 'plugin_load_textdomain'] );
			add_action( 'wp_enqueue_scripts', [$this, 'init_front_assets'] );
			add_action( 'admin_enqueue_scripts', array( $this, 'init_admin_assets' ) );
			add_shortcode('ryancv-advanced-background-html', [ $this, 'init_front_html' ] );
		}

		public function init_helpers() {
			/* includes */
		}

		public function init_admin_assets() {
			/*dashboard assets*/
			if ( $this->init_extra() ) {
				wp_enqueue_style( 'ryancv-abp-dashboard-style', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/admin/dashboard-extra.css', [], '1.0.0' );
			} else {
			wp_enqueue_style( 'ryancv-abp-dashboard-style', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/admin/dashboard-normal.css', [], '1.0.0' );
			}
			wp_enqueue_script( 'ryancv-abp-dashboard-scripts', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/admin/dashboard.js', [ 'jquery' ], '1.0.0', true );
		}

		public function init_front_assets() {
			$this->theme_bg = false;
			$custom_css = false;

			if ( class_exists( 'ACF' ) ) {
				$this->theme_bg = get_field( 'theme_bg', 'options' );
			}

			/*bg assets*/
			if ( $this->theme_bg && $this->init_extra() ) {
			if ( $this->theme_bg['type'] == 4 ) {
				wp_enqueue_script( 'ryancv-abp-tetris', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/tetris/tetris.js', array('jquery'), '1.0.0', true );
				$custom_css = ".canvas.canvas-tetris {
					background-color: {$this->theme_bg['tetris_color']} !important;
				}
				body.body-style-dark .canvas.canvas-tetris {
					background-color: {$this->theme_bg['tetris_color_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 6 ) {
				wp_enqueue_script( 'ryancv-abp-snake', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/snake/snake.js', array('jquery'), '1.0.0', true );
			}
			if ( $this->theme_bg['type'] == 7 ) {
				wp_enqueue_script( 'ryancv-abp-three-js', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/perspective/three.js', array('jquery'), '1.0.0', true );
				wp_enqueue_script( 'ryancv-abp-perspective', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/perspective/perspective.js', array('jquery'), '1.0.0', true );
				$custom_css = "
				.canvas.canvas-perspective {
					background-image: -webkit-linear-gradient(135deg, {$this->theme_bg['perspective_color1']}, {$this->theme_bg['perspective_color2']}) !important;
					background-image: linear-gradient(135deg, {$this->theme_bg['perspective_color1']}, {$this->theme_bg['perspective_color2']}) !important;
				}
				body.body-style-dark .canvas.canvas-perspective {
					background-image: -webkit-linear-gradient(135deg, {$this->theme_bg['perspective_color1_dark']}, {$this->theme_bg['perspective_color2_dark']}) !important;
					background-image: linear-gradient(135deg, {$this->theme_bg['perspective_color1_dark']}, {$this->theme_bg['perspective_color2_dark']}) !important;
				}";
			}
			if ( $this->theme_bg['type'] == 8 ) {
				wp_enqueue_style('ryancv-abp-blured', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/blured/blured.css');
				$custom_css = "
				.blured-background {
					background-color: {$this->theme_bg['blured_bgcolor']} !important;
				}
				.blured-background span:nth-child(1),
				.blured-background span:nth-child(3),
				.blured-background span:nth-child(5),
				.blured-background span:nth-child(8),
				.blured-background span:nth-child(11),
				.blured-background span:nth-child(12),
				.blured-background span:nth-child(15),
				.blured-background span:nth-child(20) {
					color: {$this->theme_bg['blured_figure_color1']} !important;
				}
				.blured-background span:nth-child(2),
				.blured-background span:nth-child(6),
				.blured-background span:nth-child(7),
				.blured-background span:nth-child(9),
				.blured-background span:nth-child(10),
				.blured-background span:nth-child(13),
				.blured-background span:nth-child(16),
				.blured-background span:nth-child(17),
				.blured-background span:nth-child(19) {
					color: {$this->theme_bg['blured_figure_color2']} !important;
				}
				.blured-background span:nth-child(4),
				.blured-background span:nth-child(14),
				.blured-background span:nth-child(18) {
					color: {$this->theme_bg['blured_figure_color3']} !important;
				}
				body.body-style-dark .blured-background {
					background-color: {$this->theme_bg['blured_bgcolor_dark']} !important;
				}
				body.body-style-dark .blured-background span:nth-child(1),
				body.body-style-dark .blured-background span:nth-child(3),
				body.body-style-dark .blured-background span:nth-child(5),
				body.body-style-dark .blured-background span:nth-child(8),
				body.body-style-dark .blured-background span:nth-child(11),
				body.body-style-dark .blured-background span:nth-child(12),
				body.body-style-dark .blured-background span:nth-child(15),
				body.body-style-dark .blured-background span:nth-child(20) {
					color: {$this->theme_bg['blured_figure_color1_dark']} !important;
				}
				body.body-style-dark .blured-background span:nth-child(2),
				body.body-style-dark .blured-background span:nth-child(6),
				body.body-style-dark .blured-background span:nth-child(7),
				body.body-style-dark .blured-background span:nth-child(9),
				body.body-style-dark .blured-background span:nth-child(10),
				body.body-style-dark .blured-background span:nth-child(13),
				body.body-style-dark .blured-background span:nth-child(16),
				body.body-style-dark .blured-background span:nth-child(17),
				body.body-style-dark .blured-background span:nth-child(19) {
					color: {$this->theme_bg['blured_figure_color2_dark']} !important;
				}
				body.body-style-dark .blured-background span:nth-child(4),
				body.body-style-dark .blured-background span:nth-child(14),
				body.body-style-dark .blured-background span:nth-child(18) {
					color: {$this->theme_bg['blured_figure_color3_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 9 ) {
				wp_enqueue_script( 'ryancv-abp-particles', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/particles/particles.js', array('jquery'), '1.0.0', true );
				$custom_css = "
				.canvas.canvas-particles {
					background-color: {$this->theme_bg['particles_bgcolor']} !important;
				}
				body.body-style-dark .canvas.canvas-particles {
					background-color: {$this->theme_bg['particles_bgcolor_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 10 ) {
				wp_enqueue_script( 'ryancv-abp-TweenLite', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/cyberlines/TweenLite.min.js', array('jquery'), '1.0.0', true );
				wp_enqueue_script( 'ryancv-abp-CSSPlugin', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/cyberlines/CSSPlugin.min.js', array('jquery'), '1.0.0', true );
				wp_enqueue_script( 'ryancv-abp-cyberlines', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/cyberlines/cyberlines.js', array('jquery'), '1.0.0', true );
				$custom_css = "
				.canvas.canvas-cyberlines {
					background-color: {$this->theme_bg['cyber_bgcolor']} !important;
				}
				body.body-style-dark .canvas.canvas-cyberlines {
					background-color: {$this->theme_bg['cyber_bgcolor_dark']} !important;
				}
				.canvas-cyberlines .line,
				.canvas-cyberlines .light {
					fill: {$this->theme_bg['cyber_linecolor']} !important;
				}
				body.body-style-dark .canvas-cyberlines .line,
				body.body-style-dark .canvas-cyberlines .light {
					fill: {$this->theme_bg['cyber_linecolor_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 11 ) {
				wp_enqueue_script( 'ryancv-abp-ClassicalNoise', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/spiral/perlin-noise-classical.js', array('jquery'), '1.0.0', true );
				wp_enqueue_script( 'ryancv-abp-spiral', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/spiral/spiral.js', array('jquery'), '1.0.0', true );
				$custom_css = "
				.canvas.canvas-spiral {
					background-color: {$this->theme_bg['spiral_bgcolor']} !important;
				}
				body.body-style-dark .canvas.canvas-spiral {
					background-color: {$this->theme_bg['spiral_bgcolor_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 12 ) {
				wp_enqueue_style('ryancv-abp-waves', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/waves/waves.css');
				$custom_css = "
				.canvas.canvas-waves {
					background-color: {$this->theme_bg['waves_bgcolor']} !important;
				}
				.wave-background .wave {
					background-color: {$this->theme_bg['waves_color1']} !important;
				}
				.wave-background .wave.-three {
					background-color: {$this->theme_bg['waves_color2']} !important;
				}
				body.body-style-dark .canvas.canvas-waves {
					background-color: {$this->theme_bg['waves_bgcolor_dark']} !important;
				}
				body.body-style-dark .wave-background .wave {
					background-color: {$this->theme_bg['waves_color1_dark']} !important;
				}
				body.body-style-dark .wave-background .wave.-three {
					background-color: {$this->theme_bg['waves_color2_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 13 ) {
				wp_enqueue_style('ryancv-abp-boxes', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/boxes/boxes.css');
				$custom_css = "
				.canvas.canvas-boxes {
					background-color: {$this->theme_bg['boxes_bgcolor']} !important;
				}
				.canvas.canvas-boxes .culd {
					border-color: {$this->theme_bg['boxes_color']} !important;
				}
				body.body-style-dark .canvas.canvas-boxes {
					background-color: {$this->theme_bg['boxes_bgcolor_dark']} !important;
				}
				body.body-style-dark .canvas.canvas-boxes .culd {
					border-color: {$this->theme_bg['boxes_color_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 14 ) {
				wp_enqueue_script( 'ryancv-abp-matrix', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/matrix/matrix.js', array('jquery'), '1.0.0', true );
			}
			if ( $this->theme_bg['type'] == 15 ) {
				wp_enqueue_style('ryancv-abp-ocean', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/ocean/ocean.css');
				$custom_css = "
				.canvas.canvas-ocean {
					background-color: {$this->theme_bg['ocean_color']} !important;
				}
				body.body-style-dark .canvas.canvas-ocean {
					background-color: {$this->theme_bg['ocean_color_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 16 ) {
				wp_enqueue_script( 'ryancv-abp-ShaderProgram', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/digital/ShaderProgram.js', array('jquery'), '1.0.0', true );
				wp_enqueue_script( 'ryancv-abp-digital', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/digital/digital.js', array('jquery'), '1.0.0', true );
				$custom_css = "
				.canvas.canvas-digital {
					background-color: {$this->theme_bg['digital_bgcolor']} !important;
				}
				body.body-style-dark .canvas.canvas-digital {
					background-color: {$this->theme_bg['digital_bgcolor_dark']} !important;
				}";
			}
			if ( $this->theme_bg['type'] == 17 ) {
				wp_enqueue_style('ryancv-abp-cybergrid', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/cybergrid/cybergrid.css');
				$custom_css = "
				.cybergrid-background .cybergrid-top {
					background-image: -webkit-linear-gradient(left, {$this->theme_bg['cybergrid_color1']}, {$this->theme_bg['cybergrid_color2']} 35%) !important;
					background-image: linear-gradient(90deg, {$this->theme_bg['cybergrid_color1']}, {$this->theme_bg['cybergrid_color2']} 35%) !important;
				}
				body.body-style-dark .cybergrid-background .cybergrid-top {
					background-image: -webkit-linear-gradient(top, {$this->theme_bg['cybergrid_color1_dark']}, {$this->theme_bg['cybergrid_color2_dark']}) !important;
					background-image: linear-gradient(180deg, {$this->theme_bg['cybergrid_color1_dark']}, {$this->theme_bg['cybergrid_color2_dark']}) !important;
				}
				.cybergrid-background .cybergrid-top::before {
					background: {$this->theme_bg['cybergrid_color3']} !important;
				}
				body.body-style-dark .cybergrid-background .cybergrid-top::before {
					background: {$this->theme_bg['cybergrid_color3_dark']} !important;
				}
				.cybergrid-background .cybergrid-bottom {
					background: {$this->theme_bg['cybergrid_color4']} !important;
				}
				body.body-style-dark .cybergrid-background .cybergrid-bottom {
					background: {$this->theme_bg['cybergrid_color4_dark']} !important;
				}
				.cybergrid-background .cybergrid-bottom .cb-wave {
					background: {$this->theme_bg['cybergrid_color5_dark']} !important;
				}";
			}

			if ( $custom_css ) {
				wp_enqueue_style( 'ryancv-abp-custom', RYANCV_ADVANCED_BACKGROUND_URI . 'assets/front/custom.css' );
				wp_add_inline_style( 'ryancv-abp-custom', $custom_css );
			}
			}
		}

		public function init_front_html() {
			$html = '';

			$this->theme_bg = false;
			if ( class_exists( 'ACF' ) ) {
				$this->theme_bg = get_field( 'theme_bg', 'options' );
			}

			if ( $this->theme_bg && $this->init_extra() ) {

			if ( $this->theme_bg['type'] == 4 ) {
				$html = '<div id="canvas_tetris" class="canvas canvas-tetris" data-tcon="' . esc_attr( $this->theme_bg['tetris_color1'] ) . '" data-tctw="' . esc_attr( $this->theme_bg['tetris_color2'] ) . '" data-tcth="' . esc_attr( $this->theme_bg['tetris_color3'] ) . '"></div>';
			}

			if ( $this->theme_bg['type'] == 6 ) {
				$html = '<div id="canvas_snake" class="canvas canvas-snake" data-colorone="'. esc_attr( $this->theme_bg['snake_bgcolor'] ) . '" data-coloroned="'. esc_attr( $this->theme_bg['snake_bgcolor_dark'] ) . '" data-colortwo="' . esc_attr( $this->theme_bg['snake_line_color'] ) . '"></div>';
			}

			if ( $this->theme_bg['type'] == 7 ) {
				$html = '<div id="canvas_perspective" class="canvas canvas-perspective"></div>';
			}

			if ( $this->theme_bg['type'] == 8 ) {
				$html = '<div class="blured-background"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>';
			}

			if ( $this->theme_bg['type'] == 9 ) {
				$html = '<div id="canvas_particles" class="canvas canvas-particles" data-colorone="' . esc_attr( $this->theme_bg['particles_color1'] ) . '" data-colortwo="' . esc_attr( $this->theme_bg['particles_color2'] ) . '" data-colorthree="' . esc_attr( $this->theme_bg['particles_color3'] ) . '" data-colorfour="' . esc_attr( $this->theme_bg['particles_color4'] ) . '" data-colorfive="' . esc_attr( $this->theme_bg['particles_color5'] ) . '"><canvas id="canvas" width="1950px" height="800px"></canvas></div>';
			}

			if ( $this->theme_bg['type'] == 10 ) {
				$html = '<div id="canvas_cyberlines" class="canvas canvas-cyberlines">';
					$html .= '<svg id="cyberlines" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewbox="0 0 1920 1080" xml:space="preserve" preserveAspectRatio="none">';
						$html .= '<g class="lines"><rect class="line" x="1253.6" width="4.5" height="1080"></rect><rect class="line" x="873.3" width="1.8" height="1080"></rect><rect class="line" x="1100" width="1.8" height="1080"></rect><rect class="line" x="1547.1" width="4.5" height="1080"></rect><rect class="line" x="615" width="4.5" height="1080"></rect><rect class="line" x="684.6" width="1.8" height="1080"></rect><rect class="line" x="1369.4" width="1.8" height="1080"></rect><rect class="line" x="1310.2" width="0.9" height="1080"></rect><rect class="line" x="1233.4" width="0.9" height="1080"></rect><rect class="line" x="124.2" width="0.9" height="1080"></rect><rect class="line" x="1818.4" width="4.5" height="1080"></rect><rect class="line" x="70.3" width="4.5" height="1080"></rect><rect class="line" x="1618.6" width="1.8" height="1080"></rect><rect class="line" x="455.9" width="1.8" height="1080"></rect><rect class="line" x="328.7" width="1.8" height="1080"></rect><rect class="line" x="300.8" width="4.6" height="1080"></rect><rect class="line" x="1666.4" width="0.9" height="1080"></rect></g>';
						$html .= '<g class="lights"><path class="light1 light" d="M619.5,298.4H615v19.5h4.5V298.4z M619.5,674.8H615v9.8h4.5V674.8z M619.5,135.1H615v5.6h4.5V135.1zM619.5,55.5H615v68.7h4.5V55.5z"></path><path class="light2 light" d="M1258.2,531.9h-4.5v8.1h4.5V531.9z M1258.2,497.9h-4.5v17.9h4.5V497.9z M1258.2,0h-4.5v25.3h4.5V0zM1258.2,252.2h-4.5v42.4h4.5V252.2z"></path><path class="light3 light" d="M875.1,123.8h-1.8v4h1.8V123.8z M875.1,289.4h-1.8v24.1h1.8V289.4z M875.1,0h-1.8v31.4h1.8V0z M875.1,50.2h-1.8v11.5h1.8V50.2z"></path><path class="light4 light" d="M1101.8,983.8h-1.8v8.2h1.8V983.8z M1101.8,1075.9h-1.8v4.1h1.8V1075.9z M1101.8,873.7h-1.8v4.2h1.8V873.7zM1101.8,851h-1.8v18.2h1.8V851z"></path><path class="light5 light" d="M686.4,822.7h-1.8v3.8h1.8V822.7z M686.4,928.4h-1.8v23h1.8V928.4z M686.4,1043.8h-1.8v36.2h1.8V1043.8z"></path><path class="light6 light" d="M1551.6,860.9h-4.4v-34.1h4.4V860.9z M1551.6,533.5h-4.4v-13.9h4.4V533.5z M1551.6,1080h-4.4v-89.1h4.4V1080z"></path><path class="light7 light" d="M1311.1,707.7h-0.9V698h0.9V707.7z M1311.1,436.8h-0.9v-58.9h0.9V436.8z M1311.1,140.7h-0.9V48h0.9V140.7z"></path><path class="light8 light" d="M125.1,514.5h-0.9v-9.7h0.9V514.5z M125.1,243.6h-0.9v-58.9h0.9V243.6z"></path><path class="light9 light" d="M305.4,806.7h-4.6v-42.5h4.6V806.7z M305.4,398.5h-4.6v-17.3h4.6V398.5z M305.4,1080h-4.6V968.8h4.6V1080z"></path><path class="light10 light" d="M1822.9,170.7h-4.5v13.7h4.5V170.7z M1822.9,435.1h-4.5v6.8h4.5V435.1z M1822.9,55.9h-4.5v4h4.5V55.9zM1822.9,0h-4.5v48.3h4.5V0z"></path><path class="light11 light" d="M1666.4,331.5h0.9v9.7h-0.9V331.5z M1666.4,602.4h0.9v58.9h-0.9V602.4z M1666.4,898.5h0.9v92.7h-0.9V898.5z"></path><path class="light12 light" d="M1620.4,200.7h-1.8v6.4h1.8V200.7z M1620.4,469.1h-1.8v39h1.8V469.1z M1620.4,0h-1.8v51h1.8V0z M1620.4,81.3h-1.8V100h1.8V81.3z"></path><path class="light13 light" d="M74.8,201h-4.5v16.2h4.5V201z M74.8,512.3h-4.5v8.1h4.5V512.3z M74.8,65.8h-4.5v4.6h4.5V65.8z M74.8,0h-4.5v56.8h4.5V0z"></path><path class="light14 light" d="M1371.2,655.3h-1.8v6.3h1.8V655.3z M1371.2,829.7h-1.8v37.9h1.8V829.7z M1371.2,1020.3h-1.8v59.7h1.8V1020.3z"></path><path class="light15 light" d="M1234.3,898.1h-0.9v-4.9h0.9V898.1z M1234.3,762.5h-0.9v-29.5h0.9V762.5z M1234.3,614.4h-0.9v-46.4h0.9V614.4z"></path><path class="light16 light" d="M457.7,1010.8h-1.8v-18.1h1.8V1010.8z M457.7,507.5h-1.8V398h1.8V507.5z"></path><path class="light17 light" d="M330.5,170.7h-1.8v13.7h1.8V170.7z M330.5,435.1h-1.8v6.8h1.8V435.1z M330.5,55.9h-1.8v4h1.8V55.9z M330.5,0h-1.8v48.3h1.8V0z"></path></g>';
					$html .= '</svg>';
				$html .= '</div>';
			}

			if ( $this->theme_bg['type'] == 11 ) {
				$html = '<div id="canvas_spiral" class="canvas canvas-spiral" data-colorone="' . esc_attr( $this->theme_bg['spiral_color'] ) . '" data-coloroned="' . esc_attr( $this->theme_bg['spiral_color_dark'] ) . '"><canvas id="canvas"></canvas></div>';
			}

			if ( $this->theme_bg['type'] == 12 ) {
				$html = '<div class="canvas canvas-waves"><div class="wave-background"><div class="wave -one"></div><div class="wave -two"></div><div class="wave -three"></div></div></div>';
			}

			if ( $this->theme_bg['type'] == 13 ) {
				$html = '<div class="canvas canvas-boxes"><div class="culd"></div><div class="culd"></div><div class="culd"></div><div class="culd"></div><div class="culd"></div></div>';
			}

			if ( $this->theme_bg['type'] == 14 ) {
				$html = '<div class="canvas canvas-matrix" id="canvas_matrix_bg" data-cbg="' . esc_attr( $this->theme_bg['matrix_bgcolor'] ) . '" data-cbgd="' . esc_attr( $this->theme_bg['matrix_bgcolor_dark'] ) . '"><canvas id="canvas_matrix" data-ctx="' . esc_attr( $this->theme_bg['matrix_color'] ) . '" data-ctxd="' . esc_attr( $this->theme_bg['matrix_color_dark'] ) . '"></canvas></div>';
			}

			if ( $this->theme_bg['type'] == 15 ) {
				$html = '
				<div class="canvas canvas-ocean">

				<svg class="ocean-light" viewBox="0 0 2000 1125" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_2_79)">
				<rect width="2000" height="1125" fill="' . esc_attr( $this->theme_bg['ocean_color'] ) . '"/>
				<path d="M1002.62 0H2000V1125H-1L4.46725 639.133L398.107 602.001C637.869 602.001 726.004 543.772 784.717 338.922C804.309 270.563 890.937 160.376 890.937 160.376C890.937 160.376 982.317 94.8034 1002.62 0Z" fill="url(#paint0_radial_2_79)"/>
				<path d="M1333.78 -3H2000V1122H-1V633.763L655.847 608.482C895.609 608.482 1005.61 579.484 1064.33 374.633C1083.92 306.274 1185.56 174.036 1216.63 128.935C1239.69 95.4517 1256.46 73.6327 1290.82 44.4017C1310.35 13.5906 1333.78 -3 1333.78 -3Z" fill="url(#paint1_radial_2_79)"/>
				<path d="M1333.78 0H2000V1125H-1V636.763C-1 636.763 6.8103 635.183 881.564 635.183C1121.33 635.183 1076.69 524.812 1135.4 319.961C1154.99 251.602 1185.56 177.036 1216.63 131.935C1239.69 98.4517 1256.46 76.6327 1290.82 47.4017C1310.35 16.5906 1333.78 0 1333.78 0Z" fill="url(#paint2_linear_2_79)"/>
				<path d="M1557.16 0H2000V1125H-1V636.763C-1 636.763 145.834 728.406 1020.59 728.406C1260.35 728.406 1336.21 528.412 1407.98 327.862C1470.46 153.265 1557.16 0 1557.16 0Z" fill="url(#paint3_linear_2_79)"/>
				<g filter="url(#filter0_b_2_79)">
				<path d="M1557.16 0H2000V1125H-1V636.763C-1 636.763 105.746 650.5 980.5 650.5C1220.26 650.5 1336.21 528.412 1407.98 327.862C1470.46 153.265 1557.16 0 1557.16 0Z" fill="white" fill-opacity="0.01"/>
				</g>
				<path d="M1789.9 0H2000V1125H-1V636.763C-1 636.763 276.266 808.199 1151.02 808.199C1390.78 808.199 1560.84 553.861 1636.04 338.132C1701.65 116.134 1789.9 0 1789.9 0Z" fill="url(#paint4_linear_2_79)"/>
				<path d="M1811 746C1877.08 652.311 1998 518 1998 518V785L1918.5 895.5L1811 937H1504.5C1504.5 937 1749.1 833.761 1811 746Z" fill="url(#paint5_linear_2_79)"/>
				<path opacity="0.2" d="M1665.41 896.826C1588.6 891.499 1582.06 901.89 1545.56 888.514C1516.37 877.814 1491.95 873.499 1483.39 872.68C1449.73 870.346 1419.47 879.77 1387.79 877.573C1363.42 875.882 1343.8 884.011 1338.38 883.635C1332.97 883.26 1321.06 898.023 1285.85 895.581C1250.64 893.139 1158.54 940.211 1139 937.5C1139 937.5 1556.55 985.011 1665.41 896.826Z" fill="url(#paint6_linear_2_79)"/>
				<path d="M1035.5 962.118C1077.5 928.741 1144.55 930.596 1195.74 915.761C1236.69 903.894 1270.5 900.309 1282.29 900H1359.54C1366.05 905.254 1385.79 915.761 1412.59 915.761C1446.1 915.761 1472.15 928.741 1479.6 928.741C1487.05 928.741 1501.94 950.065 1550.33 950.065C1598.73 950.065 1716.01 990.354 1743 988.5C1743 988.5 1176.05 1093.07 1035.5 962.118Z" fill="url(#paint7_linear_2_79)"/>
				<path d="M1811 947C1877.08 853.311 1998 719 1998 719V1124.5H1461C1461 1124.5 1749.1 1034.76 1811 947Z" fill="url(#paint8_linear_2_79)"/>
				</g>
				<defs>
				<filter id="filter0_b_2_79" x="-61" y="-60" width="2121" height="1245" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix"/>
				<feGaussianBlur in="BackgroundImageFix" stdDeviation="30"/>
				<feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_2_79"/>
				<feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_2_79" result="shape"/>
				</filter>
				<radialGradient id="paint0_radial_2_79" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(999 68) rotate(100.968) scale(772.613 1374.22)">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0.2"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</radialGradient>
				<radialGradient id="paint1_radial_2_79" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(1070 166) rotate(93.1239) scale(596.386 1060.77)">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0.3"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</radialGradient>
				<linearGradient id="paint2_linear_2_79" x1="1478.5" y1="29" x2="724" y2="860.5" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0.4"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint3_linear_2_79" x1="1706" y1="27.9999" x2="908" y2="1064" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0.7"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint4_linear_2_79" x1="1836" y1="0.00011728" x2="1549" y2="1125" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint5_linear_2_79" x1="1894" y1="649" x2="1892" y2="895.5" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint6_linear_2_79" x1="1421.57" y1="856.364" x2="1422.65" y2="913.074" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint7_linear_2_79" x1="1386.14" y1="900" x2="1379.97" y2="982.956" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint8_linear_2_79" x1="1922" y1="763.5" x2="1648.5" y2="1226" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '"/>
				<stop offset="0.764652" stop-color="' . esc_attr( $this->theme_bg['ocean_color2'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<clipPath id="clip0_2_79">
				<rect width="2000" height="1125" fill="white"/>
				</clipPath>
				</defs>
				</svg>

				<svg class="ocean-dark" viewBox="0 0 2000 1125" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_2_79_dark)">
				<rect width="2000" height="1125" fill="' . esc_attr( $this->theme_bg['ocean_color_dark'] ) . '"/>
				<path d="M1002.62 0H2000V1125H-1L4.46725 639.133L398.107 602.001C637.869 602.001 726.004 543.772 784.717 338.922C804.309 270.563 890.937 160.376 890.937 160.376C890.937 160.376 982.317 94.8034 1002.62 0Z" fill="url(#paint0_radial_2_79_dark)"/>
				<path d="M1333.78 -3H2000V1122H-1V633.763L655.847 608.482C895.609 608.482 1005.61 579.484 1064.33 374.633C1083.92 306.274 1185.56 174.036 1216.63 128.935C1239.69 95.4517 1256.46 73.6327 1290.82 44.4017C1310.35 13.5906 1333.78 -3 1333.78 -3Z" fill="url(#paint1_radial_2_79_dark)"/>
				<path d="M1333.78 0H2000V1125H-1V636.763C-1 636.763 6.8103 635.183 881.564 635.183C1121.33 635.183 1076.69 524.812 1135.4 319.961C1154.99 251.602 1185.56 177.036 1216.63 131.935C1239.69 98.4517 1256.46 76.6327 1290.82 47.4017C1310.35 16.5906 1333.78 0 1333.78 0Z" fill="url(#paint2_linear_2_79_dark)"/>
				<path d="M1557.16 0H2000V1125H-1V636.763C-1 636.763 145.834 728.406 1020.59 728.406C1260.35 728.406 1336.21 528.412 1407.98 327.862C1470.46 153.265 1557.16 0 1557.16 0Z" fill="url(#paint3_linear_2_79_dark)"/>
				<g filter="url(#filter0_b_2_79_dark)">
				<path d="M1557.16 0H2000V1125H-1V636.763C-1 636.763 105.746 650.5 980.5 650.5C1220.26 650.5 1336.21 528.412 1407.98 327.862C1470.46 153.265 1557.16 0 1557.16 0Z" fill="white" fill-opacity="0.01"/>
				</g>
				<path d="M1789.9 0H2000V1125H-1V636.763C-1 636.763 276.266 808.199 1151.02 808.199C1390.78 808.199 1560.84 553.861 1636.04 338.132C1701.65 116.134 1789.9 0 1789.9 0Z" fill="url(#paint4_linear_2_79_dark)"/>
				<path d="M1811 746C1877.08 652.311 1998 518 1998 518V785L1918.5 895.5L1811 937H1504.5C1504.5 937 1749.1 833.761 1811 746Z" fill="url(#paint5_linear_2_79_dark)"/>
				<path opacity="0.2" d="M1665.41 896.826C1588.6 891.499 1582.06 901.89 1545.56 888.514C1516.37 877.814 1491.95 873.499 1483.39 872.68C1449.73 870.346 1419.47 879.77 1387.79 877.573C1363.42 875.882 1343.8 884.011 1338.38 883.635C1332.97 883.26 1321.06 898.023 1285.85 895.581C1250.64 893.139 1158.54 940.211 1139 937.5C1139 937.5 1556.55 985.011 1665.41 896.826Z" fill="url(#paint6_linear_2_79_dark)"/>
				<path d="M1035.5 962.118C1077.5 928.741 1144.55 930.596 1195.74 915.761C1236.69 903.894 1270.5 900.309 1282.29 900H1359.54C1366.05 905.254 1385.79 915.761 1412.59 915.761C1446.1 915.761 1472.15 928.741 1479.6 928.741C1487.05 928.741 1501.94 950.065 1550.33 950.065C1598.73 950.065 1716.01 990.354 1743 988.5C1743 988.5 1176.05 1093.07 1035.5 962.118Z" fill="url(#paint7_linear_2_79_dark)"/>
				<path d="M1811 947C1877.08 853.311 1998 719 1998 719V1124.5H1461C1461 1124.5 1749.1 1034.76 1811 947Z" fill="url(#paint8_linear_2_79_dark)"/>
				</g>
				<defs>
				<filter id="filter0_b_2_79_dark" x="-61" y="-60" width="2121" height="1245" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix"/>
				<feGaussianBlur in="BackgroundImageFix" stdDeviation="30"/>
				<feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_2_79"/>
				<feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_2_79" result="shape"/>
				</filter>
				<radialGradient id="paint0_radial_2_79_dark" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(999 68) rotate(100.968) scale(772.613 1374.22)">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0.2"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</radialGradient>
				<radialGradient id="paint1_radial_2_79_dark" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(1070 166) rotate(93.1239) scale(596.386 1060.77)">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0.3"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</radialGradient>
				<linearGradient id="paint2_linear_2_79_dark" x1="1478.5" y1="29" x2="724" y2="860.5" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0.4"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint3_linear_2_79_dark" x1="1706" y1="27.9999" x2="908" y2="1064" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0.7"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint4_linear_2_79_dark" x1="1836" y1="0.00011728" x2="1549" y2="1125" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint5_linear_2_79_dark" x1="1894" y1="649" x2="1892" y2="895.5" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint6_linear_2_79_dark" x1="1421.57" y1="856.364" x2="1422.65" y2="913.074" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint7_linear_2_79_dark" x1="1386.14" y1="900" x2="1379.97" y2="982.956" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '"/>
				<stop offset="1" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<linearGradient id="paint8_linear_2_79_dark" x1="1922" y1="763.5" x2="1648.5" y2="1226" gradientUnits="userSpaceOnUse">
				<stop stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '"/>
				<stop offset="0.764652" stop-color="' . esc_attr( $this->theme_bg['ocean_color2_dark'] ) . '" stop-opacity="0"/>
				</linearGradient>
				<clipPath id="clip0_2_79_dark">
				<rect width="2000" height="1125" fill="white"/>
				</clipPath>
				</defs>
				</svg>
				
				</div>';
			}

			if ( $this->theme_bg['type'] == 16 ) {
				$html = '
				<div class="canvas canvas-digital" id="canvas_digital" data-digitald="' . esc_attr( $this->theme_bg['digital_color'] ) . '"></div>';
			}

			if ( $this->theme_bg['type'] == 17 ) {
				$html = '<div class="canvas cybergrid-background">
				<div class="cybergrid-top"></div>
				<div class="cybergrid-bottom">
					<div class="cb-ground">
					<div class="cb-wave vertical wv-left wave-0"></div>
					<div class="cb-wave vertical wv-left wave-1"></div>
					<div class="cb-wave vertical wv-left wave-2"></div>
					<div class="cb-wave vertical wv-left wave-3"></div>
					<div class="cb-wave vertical wv-left wave-4"></div>
					<div class="cb-wave vertical wv-left wave-5"></div>
					<div class="cb-wave vertical wv-left wave-6"></div>
					<div class="cb-wave vertical wv-left wave-7"></div>
					<div class="cb-wave vertical wv-right wave-1"></div>
					<div class="cb-wave vertical wv-right wave-2"></div>
					<div class="cb-wave vertical wv-right wave-3"></div>
					<div class="cb-wave vertical wv-right wave-4"></div>
					<div class="cb-wave vertical wv-right wave-5"></div>
					<div class="cb-wave vertical wv-right wave-6"></div>
					<div class="cb-wave vertical wv-right wave-7"></div>
					<div class="cb-wave horizontal wave-9"></div>
					<div class="cb-wave horizontal wave-10"></div>
					<div class="cb-wave horizontal wave-11"></div>
					<div class="cb-wave horizontal wave-12"></div>
					<div class="cb-wave horizontal wave-13"></div>
					<div class="cb-wave horizontal wave-14"></div>
					<div class="cb-wave horizontal wave-15"></div>
					<div class="cb-wave horizontal wave-16"></div>
					<div class="cb-wave horizontal wave-17"></div>
					<div class="cb-wave horizontal wave-18"></div>
					<div class="cb-wave horizontal wave-19"></div>
					</div>
				</div>
				</div>';
			}

			return $html;
			} else {
			return false;
			}
		}

		protected function init_extra() {
			$extra_dir = get_option( RYANCV_ADVANCED_BACKGROUND_SLUG . '_lic_Ren' );
			if ( empty( $extra_dir ) ) {
				$extra_dir = false;
			}
			return $extra_dir;
		}
	}

}

$ryancvAdvancedBackground = new RyanCVAdvancedBackground();
$ryancvAdvancedBackground->init();