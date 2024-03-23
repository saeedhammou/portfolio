<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Skills Widget.
 *
 * @since 1.0
 */

class RyanCV_Resume_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-resume';
	}

	public function get_title() {
		return esc_html__( 'Resume', 'ryancv-plugin' );
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

    if ( ! $fa_version ) {

		$this->add_control(
			'title_icon',
			[
				'label'       => esc_html__( 'Title Icon', 'ryancv-plugin' ),
				'type'        => Controls_Manager::ICON,
			]
		);

    } else {

    $this->add_control(
			'title_icon',
			[
				'label'       => esc_html__( 'Title Icon', 'ryancv-plugin' ),
				'type'        => Controls_Manager::ICONS,
			]
		);

    }

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
			'active', [
				'label' => esc_html__( 'Active', 'ryancv-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'ryancv-plugin' ),
				'label_off' => esc_html__( 'No', 'ryancv-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'ryancv-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$repeater->add_control(
			'years', [
				'label'       => esc_html__( 'Years', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter years', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter years', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter title', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter subtitle', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Text', 'ryancv-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter text', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter text', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'button_type', [
				'label'       => esc_html__( 'Button (Type)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'hide',
				'options' => [
					'hide'  => __( 'Hide', 'ryancv-plugin' ),
					'link'  => __( 'Link', 'ryancv-plugin' ),
					'image' => __( 'Image', 'ryancv-plugin' ),
				],
			]
		);

		$repeater->add_control(
			'button_label', [
				'label'       => esc_html__( 'Button (Label)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Label', 'ryancv-plugin' ),
				'default'	=> esc_html__( 'Button', 'ryancv-plugin' ),
				'condition' => [
					'button_type' => ['link', 'image']
				]
			]
		);

		$repeater->add_control(
			'button_link', [
				'label'       => esc_html__( 'Button (Link)', 'ryancv-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
					'button_type' => 'link'
				]
			]
		);

		$repeater->add_control(
			'button_image', [
				'label'       => esc_html__( 'Image', 'ryancv-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'button_type' => 'image'
				]
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'ryancv-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
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
					'{{WRAPPER}} .resume-title .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .resume-title .name',
			]
		);

		$this->add_control(
			'title_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .resume-title .icon' => 'color: {{VALUE}};',
				],
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
			'items_date_color',
			[
				'label' => esc_html__( 'Date Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .resume-items .resume-item .date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'items_date2_color',
			[
				'label' => esc_html__( 'Date Active Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .resume-items .resume-item.active .date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'items_date_typography',
				'label' => esc_html__( 'Date Typography:', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .resume-items .resume-item .date',
			]
		);

		$this->add_control(
			'items_title_color',
			[
				'label' => esc_html__( 'Title Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .resume-items .resume-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'items_title_typography',
				'label' => esc_html__( 'Title Typography:', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .resume-items .resume-item .name',
			]
		);

		$this->add_control(
			'items_subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .resume-items .resume-item .company' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'items_subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography:', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .resume-items .resume-item .company',
			]
		);

		$this->add_control(
			'items_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ryancv-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .resume-items .resume-item .single-post-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'items_text_typography',
				'label' => esc_html__( 'Text Typography:', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .resume-items .resume-item .single-post-text',
			]
		);

		$this->add_control(
			'item_button_color',
			[
				'label'     => esc_html__( 'Button Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .resume-items .resume-item .single-post-text .lnk' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_button_typography',
				'label'     => esc_html__( 'Button Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .resume-items .resume-item .single-post-text .lnk',
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

		<!-- resume item -->
		<div class="resume-item">
			<?php if ( $settings['title'] ) : ?>
			<div class="resume-title border-line-h">
				<?php if ( $settings['title_icon'] ) : ?>
				<div class="icon">
          <?php if ( ! $fa_version ) : ?>
            <i class="<?php echo esc_attr( $settings['title_icon'] ); ?>"></i>
          <?php else : ?>
            <?php \Elementor\Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
          <?php endif; ?>
        </div>
				<?php endif; ?>
				<div class="name">
					<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( $settings['items'] ) : ?>
			<div class="resume-items">
				<?php foreach ( $settings['items'] as $index => $item ) :
			    $item_years = $this->get_repeater_setting_key( 'years', 'items', $index );
			    $this->add_inline_editing_attributes( $item_years, 'basic' );

					$item_title = $this->get_repeater_setting_key( 'title', 'items', $index );
			    $this->add_inline_editing_attributes( $item_title, 'basic' );

					$item_subtitle = $this->get_repeater_setting_key( 'subtitle', 'items', $index );
			    $this->add_inline_editing_attributes( $item_subtitle, 'basic' );

					$item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
			    $this->add_inline_editing_attributes( $item_text, 'advanced' );

					$item_button = $this->get_repeater_setting_key( 'button_label', 'items', $index );
		      $this->add_inline_editing_attributes( $item_button, 'none' );
			  ?>
				<div class="resume-item border-line-h <?php if ( $item['active'] == 'yes' ) : ?>active<?php endif; ?>">
					<?php if ( !empty($item['image']['url']) ) : ?>
					<div class="image">
						<img src="<?php echo esc_url( $item['image']['url'] ); ?>"<?php if ( $item['title'] ) : ?> alt="<?php echo esc_attr( $item['title'] ); ?>"<?php endif; ?> />
					</div>
					<?php endif; ?>
					<?php if ( $item['years'] ) : ?>
					<div class="date">
						<span <?php echo $this->get_render_attribute_string( $item_years ); ?>>
							<?php echo wp_kses_post( $item['years'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['title'] ) : ?>
					<div class="name">
						<span <?php echo $this->get_render_attribute_string( $item_title ); ?>>
							<?php echo wp_kses_post( $item['title'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['subtitle'] ) : ?>
					<div class="company">
						<span <?php echo $this->get_render_attribute_string( $item_subtitle ); ?>>
							<?php echo wp_kses_post( $item['subtitle'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['text'] ) : ?>
					<div class="single-post-text">
						<div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
							<?php echo wp_kses_post( $item['text'] ); ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $item['button_label'] ) : ?>
					<?php if ( $item['button_type'] == 'image' ) : ?>
					<a href="<?php echo esc_url( $item['button_image']['url'] ); ?>" class="lnk lnk-2">
					<?php endif; ?>
					<?php if ( $item['button_type'] == 'link' ) : ?>
					<a<?php if ( $item['button_link'] ) : if ( $item['button_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['button_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['button_link']['url'] ); ?>"<?php endif; ?> class="lnk lnk-2">
					<?php endif; ?>
						<span class="text" <?php echo $this->get_render_attribute_string( $item_button ); ?>>
							<?php echo esc_html( $item['button_label'] ); ?>
						</span>
						<i class="fas fa-angle-right"></i>
					</a>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Resume_Widget() );
