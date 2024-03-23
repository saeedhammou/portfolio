<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Pricing Widget.
 *
 * @since 1.0
 */
class RyanCV_Pricing_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-pricing';
	}

	public function get_title() {
		return esc_html__( 'Pricing', 'ryancv-plugin' );
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
			'title_tab',
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
				'default'     => esc_html__( 'Enter title', 'ryancv-plugin' ),
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
					'div' => __( 'DIV', 'ryancv-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_tab',
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
				'label'       => esc_html__( 'Title', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ryancv-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'price', [
				'label'       => esc_html__( 'Price', 'ryancv-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 100,
				'default'	=> 100,
			]
		);

		$repeater->add_control(
			'price_before', [
				'label'       => esc_html__( 'Price (before)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '$', 'ryancv-plugin' ),
				'default'	=> esc_html__( '$', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'price_after', [
				'label'       => esc_html__( 'Price (after)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'hour', 'ryancv-plugin' ),
				'default'	=> esc_html__( 'hour', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'list', [
				'label' => esc_html__( 'List', 'ryancv-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
				'default'	=> esc_html__( 'Enter list', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'button', [
				'label'       => esc_html__( 'Button (title)', 'ryancv-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'ryancv-plugin' ),
				'default'	=> esc_html__( 'Button', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label'       => esc_html__( 'Button (link)', 'ryancv-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$repeater->add_control(
			'button_icon', [
				'label'       => esc_html__( 'Button Icon', 'ryancv-plugin' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
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
				'label'     => esc_html__( 'Items', 'ryancv-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-items .pricing-item .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_name_color',
			[
				'label'     => esc_html__( 'Title Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-items .pricing-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Title Typography', 'ryancv-plugin' ),
				'name'     => 'item_name_typography',
				'selector' => '{{WRAPPER}} .pricing-items .pricing-item .name',
			]
		);

		$this->add_control(
			'item_price_color',
			[

				'label'     => esc_html__( 'Price Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-items .pricing-item .amount .dollar, {{WRAPPER}} .pricing-items .pricing-item .amount .number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price_typography',
				'label'     => esc_html__( 'Price Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-items .pricing-item .amount .number',
			]
		);

		$this->add_control(
			'item_price2_color',
			[

				'label'     => esc_html__( 'Price Secondary Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-items .pricing-item .amount .period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price2_typography',
				'label'     => esc_html__( 'Price Secondary Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-items .pricing-item .amount .number .dollar, {{WRAPPER}} .pricing-items .pricing-item .amount .number .period',
			]
		);

		$this->add_control(
			'item_list_color',
			[

				'label'     => esc_html__( 'List Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-items .pricing-item .feature-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_typography',
				'label'     => esc_html__( 'List Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-items .pricing-item .feature-list',
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

		<!-- Price Tables -->
		<div class="content pricing">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( $settings['items'] ) : ?>
			<!-- content -->
			<div class="row pricing-items">

				<?php foreach ( $settings['items'] as $index => $item ) :

			    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
			    $this->add_inline_editing_attributes( $item_name, 'none' );

			    $item_price = $this->get_repeater_setting_key( 'price', 'items', $index );
			    $this->add_inline_editing_attributes( $item_price, 'none' );

			    $item_price_before = $this->get_repeater_setting_key( 'price_before', 'items', $index );
			    $this->add_inline_editing_attributes( $item_price_before, 'none' );

			    $item_price_after = $this->get_repeater_setting_key( 'price_after', 'items', $index );
			    $this->add_inline_editing_attributes( $item_price_after, 'none' );

			    $item_button = $this->get_repeater_setting_key( 'button', 'items', $index );
			    $this->add_inline_editing_attributes( $item_button, 'none' );

			    $item_list = $this->get_repeater_setting_key( 'list', 'items', $index );
			    $this->add_inline_editing_attributes( $item_list, 'advanced' );

			    ?>
				<!-- pricing item -->
				<div class="col col-d-6 col-t-6 col-m-12 border-line-v">
					<div class="pricing-item">
						<?php if ( $item['icon'] ) : ?>
						<div class="icon">
              <?php if ( ! $fa_version ) : ?>
              <i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
              <?php else : ?>
              <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
              <?php endif; ?>
            </div>
						<?php endif; ?>
						<?php if ( $item['name'] ) : ?>
						<div class="name">
							<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
								<?php echo esc_html( $item['name'] ); ?>
							</span>
						</div>
						<?php endif; ?>
						<?php if ( $item['price'] ) : ?>
						<div class="amount">
							<?php if ( $item['price_before'] ) : ?>
							<span class="dollar">
								<span <?php echo $this->get_render_attribute_string( $item_price_before ); ?>>
									<?php echo esc_html( $item['price_before'] ); ?>
								</span>
							</span>
							<?php endif; ?>
							<?php if ( $item['price'] ) : ?>
							<span class="number">
								<span <?php echo $this->get_render_attribute_string( $item_price ); ?>>
									<?php echo esc_html( $item['price'] ); ?>
								</span>
							</span>
							<?php endif; ?>
							<?php if ( $item['price_after'] ) : ?>
							<span class="period">
								<span <?php echo $this->get_render_attribute_string( $item_price_after ); ?>>
									<?php echo esc_html( $item['price_after'] ); ?>
								</span>
							</span>
							<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if ( $item['list'] ) : ?>
						<div class="feature-list">
							<div <?php echo $this->get_render_attribute_string( $item_list ); ?>>
								<?php echo wp_kses_post( $item['list'] ); ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( $item['button'] ) : ?>
						<div class="lnks">
							<a<?php if ( $item['link'] ) : if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?> class="lnk">
								<span class="text">
									<span <?php echo $this->get_render_attribute_string( $item_button ); ?>>
										<?php echo esc_html( $item['button'] ); ?>
									</span>
								</span>
								<i class="<?php echo esc_attr( $item['button_icon'] ); ?>"></i>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>

				<div class="clear"></div>
			</div>
			<?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Pricing_Widget() );
