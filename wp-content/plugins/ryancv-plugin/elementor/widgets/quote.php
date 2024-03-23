<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Quote Widget.
 *
 * @since 1.0
 */
class RyanCV_Quote_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-quote';
	}

	public function get_title() {
		return esc_html__( 'Quote', 'ryancv-plugin' );
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
			'text',
			[
				'label'       => esc_html__( 'Quote', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter text', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Enter text', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'name',
			[
				'label'       => esc_html__( 'Name', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter name', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Enter name', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'role',
			[
				'label'       => esc_html__( 'Role', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter role', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Enter role', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'ryancv-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
			'quote_styling',
			[
				'label'     => esc_html__( 'Quote', 'ryancv-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'quote_text_color',
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
				'name'     => 'quote_text_typography',
				'label'     => esc_html__( 'Text Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .revs-item .text',
			]
		);

		$this->add_control(
			'quote_name_color',
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
				'name'     => 'quote_name_typography',
				'label'     => esc_html__( 'Name Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .revs-item .info .name',
			]
		);

		$this->add_control(
			'quote_role_color',
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
				'name'     => 'quote_role_typography',
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
		$this->add_inline_editing_attributes( 'text', 'basic' );
		$this->add_inline_editing_attributes( 'name', 'none' );
		$this->add_inline_editing_attributes( 'role', 'none' );

		?>

		<!-- Quote -->

		<div class="content quote">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<!-- content -->
			<div class="row">
				<div class="col col-d-12 col-t-12 col-m-12 border-line-v">
					<div class="revs-item">
						<?php if ( $settings['text'] ) : ?>
						<div class="text">
							<div <?php echo $this->get_render_attribute_string( 'text' ); ?>>
								<?php echo wp_kses_post( $settings['text'] ); ?>
							</div>
						</div>
						<?php endif; ?>
						<div class="user">
							<?php if( $settings['image']['id'] ) :
				            	$image = wp_get_attachment_image_url( $settings['image']['id'], 'ryancv_92x92' );
				            ?>
							<div class="img">
								<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>" />
							</div>
							<?php endif; ?>
							<div class="info">
								<?php if ( $settings['name'] ) : ?>
								<div class="name"><?php echo esc_html( $settings['name'] ); ?></div>
								<?php endif; ?>
								<?php if( $settings['role'] ) : ?>
								<div class="company"><?php echo esc_html( $settings['role'] ); ?></div>
								<?php endif; ?>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>

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
		view.addInlineEditingAttributes( 'text', 'basic' );
		view.addInlineEditingAttributes( 'name', 'none' );
		view.addInlineEditingAttributes( 'role', 'none' );
		#>

		<!-- Quote -->

		<div class="content quote">

			<# if ( settings.title ) { #>
			<!-- title -->
			<{{{ settings.title_tag }}} class="title">
				<span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
			</{{{ settings.title_tag }}}>
			<# } #>

			<!-- content -->
			<div class="row">
				<div class="col col-d-12 col-t-12 col-m-12 border-line-v">
					<div class="revs-item">
						<# if ( settings.text ) { #>
						<div class="text">
							<span {{{ view.getRenderAttributeString( 'text' ) }}}>
								{{{ settings.text }}}
							</span>
						</div>
						<# } #>
						<div class="user">
							<# if ( settings.image.url ) { #>
							<div class="img">
								<img src="{{{ settings.image.url }}}" alt="{{{ settings.name }}}" />
							</div>
							<# } #>
							<div class="info">
								<# if ( settings.name ) { #>
								<div class="name">
									<span {{{ view.getRenderAttributeString( 'name' ) }}}>
										{{{ settings.name }}}
									</span>
								</div>
								<# } #>
								<# if ( settings.role ) { #>
								<div class="company">
									<span {{{ view.getRenderAttributeString( 'role' ) }}}>
										{{{ settings.role }}}
									</span>
								</div>
								<# } #>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Quote_Widget() );
