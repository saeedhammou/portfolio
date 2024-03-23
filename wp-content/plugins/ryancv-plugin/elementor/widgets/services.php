<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Services Widget.
 *
 * @since 1.0
 */

class RyanCV_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'ryancv-plugin' );
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
		if ( function_exists( 'get_field' ) ) {
			$fa_version = get_field( 'fa_version', 'option' );
		} else {
			$fa_version = false;
		}

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

		$repeater = new \Elementor\Repeater();

    if ( ! $fa_version ) {
  		$repeater->add_control(
  			'icon', [
  				'label'       => esc_html__( 'Icon', 'ryancv-plugin' ),
  				'type'        => Controls_Manager::ICON,
  			]
  		);
    } else {
      $repeater->add_control(
  			'icon', [
  				'label'       => esc_html__( 'Icon', 'ryancv-plugin' ),
  				'type'        => Controls_Manager::ICONS,
  			]
  		);
    }

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter name', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'description', [
				'label'       => esc_html__( 'Description', 'ryancv-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter description', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'ryancv-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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

		$this->start_controls_section(
			'items_styling',
			[
				'label' => esc_html__( 'Items', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .service-items .service-item .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'items_icon_bg',
			[
				'label' => esc_html__( 'Icon Background', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .service-items .service-item .icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'items_name_color',
			[
				'label' => esc_html__( 'Name Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .service-items .service-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'items_name_typography',
				'label' => esc_html__( 'Name Typography:', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .service-items .service-item .name',
			]
		);

		$this->add_control(
			'items_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .service-items .service-item .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'items_desc_typography',
				'label' => esc_html__( 'Description Typography:', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .service-items .service-item .desc',
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

		$this->add_inline_editing_attributes( 'title', 'basic' );

		if ( function_exists( 'get_field' ) ) {
			$fa_version = get_field( 'fa_version', 'option' );
		} else {
			$fa_version = false;
		}

		?>

		<!-- Services -->
		<div class="content services">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( $settings['items'] ) : ?>
			<!-- content -->
			<div class="row service-items border-line-v">

				<?php foreach ( $settings['items'] as $index => $item ) :
			    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
			    $this->add_inline_editing_attributes( $item_name, 'basic' );

			    $item_desc = $this->get_repeater_setting_key( 'description', 'items', $index );
			    $this->add_inline_editing_attributes( $item_desc, 'advanced' );
			  ?>
				<!-- service item -->
				<div class="col col-d-6 col-t-6 col-m-12 border-line-h">
					<div class="service-item">
						<?php if( $item['icon'] ) : ?>
							<div class="icon">
                <?php if ( ! $fa_version ) : ?>
								<span class="<?php echo esc_attr( $item['icon'] ); ?>"></span>
                <?php else : ?>
                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if( $item['name'] ) : ?>
							<div class="name">
								<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
									<?php echo wp_kses_post( $item['name'] ); ?>
								</span>
							</div>
						<?php endif; ?>
						<?php if( $item['description'] ) : ?>
							<div class="desc">
								<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
									<?php echo wp_kses_post( $item['description'] ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

			<div class="clear"></div>

			<?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Services_Widget() );
