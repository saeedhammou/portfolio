<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV CF7 Widget.
 *
 * @since 1.0
 */

class RyanCV_Custom_Google_Maps extends Widget_Base {

	public function get_name() {
		return 'ryancv-custom-gmaps';
	}

	public function get_title() {
		return esc_html__( 'Custom Google Maps', 'ryancv-plugin' );
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return [ 'ryancv-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_tab',
			[
				'label' => esc_html__( 'Content', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => '',
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Enter your Google Map Api Key in Dashboard -> Theme Options -> Google Map -> API Key ', 'ryancv-plugin' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_control(
			'gmap_lat',
			[
				'label'       => esc_html__( 'Latitude', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter latitude', 'ryancv-plugin' ),
				'default'     => '51.528308',
			]
		);

		$this->add_control(
			'gmap_long',
			[
				'label'       => esc_html__( 'Longitude', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter longitude', 'ryancv-plugin' ),
				'default'     => '-0.3817765',
			]
		);

		$this->add_control(
			'gmap_zoom',
			[
				'label' => esc_html__( 'Zoom', 'ryancv-plugin' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 16,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'gmap_height',
			[
				'label' => esc_html__( 'Height', 'ryancv-plugin' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 240,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		wp_enqueue_script( 'ryancv-gmap-el', plugin_dir_url( __FILE__ ) . '../assets/js/gmap-el.js', array('jquery'), '1.0.0', true );

		?>
		<div class="map el-map" data-zoom="<?php echo esc_attr( $settings['gmap_zoom']['size'] ); ?>" style="height: <?php echo esc_attr( $settings['gmap_height']['size'] ); ?>px">
			<div class="marker" data-lat="<?php echo esc_attr( $settings['gmap_lat'] ); ?>" data-lng="<?php echo esc_attr( $settings['gmap_long'] ); ?>" ></div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Custom_Google_Maps() );
