<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV CF7 Widget.
 *
 * @since 1.0
 */

class RyanCV_CF7_Form_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-cf7-form';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'ryancv-plugin' );
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
			'heading_tab',
			[
				'label' => esc_html__( 'Title', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Title', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', 'ryancv-plugin' ),
					'h2' => __( 'H2', 'ryancv-plugin' ),
					'h3' => __( 'H3', 'ryancv-plugin' ),
					'div' => __( 'DIV', 'ryancv-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_tab',
			[
				'label' => esc_html__( 'Content', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_form',
			[
				'label' => esc_html__( 'Select CF7 Form', 'ryancv-plugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => 1,
				'options' => $this->contact_form_list(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_styling',
			[
				'label'     => esc_html__( 'Title', 'ryancv-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .content .title',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Contact Form List.
	 *
	 * @since 1.0
	 */
	protected function contact_form_list() {
		$cf7_posts = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$cf7_forms = array();

		if ( $cf7_posts ) {
			foreach ( $cf7_posts as $cf7_form ) {
				$cf7_forms[ $cf7_form->ID ] = $cf7_form->post_title;
			}
		} else {
			$cf7_forms[ esc_html__( 'No contact forms found', 'ryancv-plugin' ) ] = 0;
		}

		return $cf7_forms;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );

		?>

		<!-- Contact Form -->
		<div class="content contacts">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( $settings['contact_form'] ) : ?>
			<!-- content -->
			<div class="row">
				<div class="col col-d-12 col-t-12 col-m-12 border-line-v">
					<div class="contact_form">
						<?php echo do_shortcode( '[contact-form-7 id="'. esc_attr( $settings['contact_form'] ) .'"]' ); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_CF7_Form_Widget() );
