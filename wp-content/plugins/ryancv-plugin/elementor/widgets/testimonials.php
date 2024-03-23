<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Testimonials Widget.
 *
 * @since 1.0
 */
class RyanCV_Testimonials_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'ryancv-plugin' );
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Text', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter text', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Enter text', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter name', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Enter name', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'role', [
				'label'       => esc_html__( 'Role', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter role', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Enter role', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'ryancv-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
			'settings_tab',
			[
				'label' => esc_html__( 'Settings', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'ryancv-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ryancv-plugin' ),
				'label_off' => esc_html__( 'No', 'ryancv-plugin' ),
				'return_value' => 1,
				'default' => 0,
			]
		);

		$this->add_control(
			'is_autoplaytime',
			[
				'label' => esc_html__( 'Autoplay Time', 'ryancv-plugin' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50000,
				'step' => 100,
				'default' => 5000,
			]
		);

		$this->add_control(
			'is_dots',
			[
				'label' => esc_html__( 'Dots', 'ryancv-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ryancv-plugin' ),
				'label_off' => esc_html__( 'No', 'ryancv-plugin' ),
				'return_value' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'is_loop',
			[
				'label' => esc_html__( 'Loop', 'ryancv-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ryancv-plugin' ),
				'label_off' => esc_html__( 'No', 'ryancv-plugin' ),
				'return_value' => 1,
				'default' => 0,
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
			'items_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .revs-item .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'items_text_typography',
				'label'     => esc_html__( 'Text Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .revs-item .text',
			]
		);

		$this->add_control(
			'items_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .revs-item .info .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'items_name_typography',
				'label'     => esc_html__( 'Name Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .revs-item .info .name',
			]
		);

		$this->add_control(
			'items_role_color',
			[
				'label'     => esc_html__( 'Role Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .revs-item .info .company' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'items_role_typography',
				'label'     => esc_html__( 'Role Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .revs-item .info .company',
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

		?>

		<!-- Testimonials -->

		<div class="content testimonials">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( $settings['items'] ) : ?>
			<!-- content -->
			<div class="row testimonial-items">

				<div class="col col-d-12 col-t-12 col-m-12 border-line-v">
					<div class="revs-carousel <?php if ( $settings['is_dots'] != '1' ) : ?>dots-disabled<?php endif; ?>">
						<div class="swiper-container" data-swiper-autoplay="<?php echo esc_attr( $settings['is_autoplay'] ); ?>" data-swiper-delay="<?php echo esc_attr( $settings['is_autoplaytime'] ); ?>" data-swiper-loop="<?php echo esc_attr( $settings['is_loop'] ); ?>"><div class="swiper-wrapper">
							<?php foreach ( $settings['items'] as $index => $item ) :
						    $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
						    $this->add_inline_editing_attributes( $item_text, 'basic' );

						    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
						    $this->add_inline_editing_attributes( $item_name, 'none' );

						    $item_role = $this->get_repeater_setting_key( 'role', 'items', $index );
						    $this->add_inline_editing_attributes( $item_role, 'none' );
						    ?>
							<div class="swiper-slide">
								<div class="revs-item">
									<?php if ( $item['text'] ) : ?>
									<div class="text">
										<div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
											<?php echo wp_kses_post( $item['text'] ); ?>
										</div>
									</div>
									<?php endif; ?>
									<div class="user">
										<?php if( $item['image']['id'] ) :
							            	$image = wp_get_attachment_image_url( $item['image']['id'], 'ryancv_92x92' );
							            ?>
										<div class="img">
											<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
										</div>
										<?php endif; ?>
										<div class="info">
											<?php if( $item['name'] ) : ?>
											<div class="name">
												<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
													<?php echo esc_html( $item['name'] ); ?>
												</span>
											</div>
											<?php endif; ?>
											<?php if( $item['role'] ) : ?>
											<div class="company">
												<span <?php echo $this->get_render_attribute_string( $item_role ); ?>>
													<?php echo esc_html( $item['role'] ); ?>
												</span>
											</div>
											<?php endif; ?>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div></div>
						<div class="swiper-pagination"></div>
					</div>
				</div>

				<div class="clear"></div>
			</div>
			<?php endif; ?>
		</div>

		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		#>

		<!-- Testimonials -->

		<div class="content testimonials">

			<# if ( settings.title ) { #>
			<!-- title -->
			<{{{ settings.title_tag }}} class="title">
				<span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
			</{{{ settings.title_tag }}}>
			<# } #>

			<# if ( settings.items ) { #>
			<!-- content -->
			<div class="row testimonial-items">

				<div class="col col-d-12 col-t-12 col-m-12 border-line-v">
					<div class="revs-carousel">
						<div class="swiper-container" data-swiper-autoplay="{{{ settings.is_autoplay }}}" data-swiper-delay="{{{ settings.is_autoplaytime }}}" data-swiper-loop="{{{ settings.is_loop }}}"><div class="swiper-wrapper">

						    <# _.each( settings.items, function( item, index ) {

						    var item_text = view.getRepeaterSettingKey( 'text', 'items', index );
						    view.addInlineEditingAttributes( item_text, 'basic' );

						    var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
						    view.addInlineEditingAttributes( item_name, 'none' );

						    var item_role = view.getRepeaterSettingKey( 'role', 'items', index );
						    view.addInlineEditingAttributes( item_role, 'none' );

						    #>
							<div class="swiper-slide">
								<div class="revs-item">
									<# if ( item.text ) { #>
									<div class="text">
										<div {{{ view.getRenderAttributeString( item_text ) }}}>
											{{{ item.text }}}
										</div>
									</div>
									<# } #>
									<div class="user">
										<# if ( item.image.url ) { #>
										<div class="img">
											<img src="{{{ item.image.url }}}" alt="{{{ item.name }}}" />
										</div>
										<# } #>
										<div class="info">
											<# if ( item.name ) { #>
											<div class="name">
												<span {{{ view.getRenderAttributeString( item_name ) }}}>
													{{{ item.name }}}
												</span>
											</div>
											<# } #>
											<# if ( item.role ) { #>
											<div class="company">
												<span {{{ view.getRenderAttributeString( item_role ) }}}>
													{{{ item.role }}}
												</span>
											</div>
											<# } #>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<# }); #>
						</div></div>
					</div>
				</div>

				<div class="clear"></div>
			</div>
			<# } #>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Testimonials_Widget() );
