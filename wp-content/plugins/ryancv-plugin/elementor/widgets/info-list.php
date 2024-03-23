<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Info List Widget.
 *
 * @since 1.0
 */
class RyanCV_Info_List_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-info-list';
	}

	public function get_title() {
		return esc_html__( 'Info List', 'ryancv-plugin' );
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label', [
				'label'       => esc_html__( 'Label', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter label', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter label', 'ryancv-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'label'       => esc_html__( 'Value', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter value', 'ryancv-plugin' ),
				'default' => esc_html__( 'Enter value', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'ryancv-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'columns_styling',
			[
				'label' => esc_html__( 'Columns', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'columns',
			[
				'label'       => esc_html__( 'Columns', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					1 => 1,
					2 => 2,
				],
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
			'items_label_color',
			[
				'label'     => esc_html__( 'Label Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .info-list ul li strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'items_label_bg',
			[
				'label'     => esc_html__( 'Label Background Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .info-list ul li strong' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'items_label_typography',
				'label'     => esc_html__( 'Label Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .info-list ul li strong',
			]
		);

		$this->add_control(
			'items_value_color',
			[
				'label'     => esc_html__( 'Value Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .info-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'items_value_typography',
				'label'     => esc_html__( 'Value Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .info-list',
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

		?>

		<!-- content -->
		<div class="row">
			<?php
				$col_class = 'col col-d-12 col-t-12 col-m-12 col-list-2';

				if ( $settings['columns'] == 1 ) {
					$col_class = 'col col-d-12 col-t-12 col-m-12 col-list-1';
				}
			?>

			<?php if ( $settings['items'] ) : ?>
			<div class="<?php echo esc_attr( $col_class );?> border-line-v">
				<div class="info-list">
					<ul>
						<?php foreach ( $settings['items'] as $index => $item ) :
					    $item_label = $this->get_repeater_setting_key( 'label', 'items', $index );
					    $this->add_inline_editing_attributes( $item_label, 'basic' );

					    $item_value = $this->get_repeater_setting_key( 'value', 'items', $index );
					    $this->add_inline_editing_attributes( $item_value, 'basic' );
					    ?>
						<li>
							<strong>
								<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
									<?php echo wp_kses_post( $item['label'] ); ?>
								</span>
							</strong>
							<span <?php echo $this->get_render_attribute_string( $item_value ); ?>>
								<?php echo wp_kses_post( $item['value'] ); ?>
							</span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>

			<div class="clear"></div>
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

		<!-- content -->
		<div class="row">
			<#
				var col_class = 'col col-d-6 col-t-12 col-m-12 col-list-2';

				if ( settings.columns == 1 ) {
					col_class = 'col col-d-12 col-t-12 col-m-12 col-list-1';
				}
			#>

			<# if ( settings.items ) { #>
			<div class="{{{ col_class }}} border-line-v">
				<div class="info-list">
					<ul>
						<# _.each( settings.items, function( item, index ) {

					    var item_label = view.getRepeaterSettingKey( 'label', 'items', index );
					    view.addInlineEditingAttributes( item_label, 'basic' );

					    var item_value = view.getRepeaterSettingKey( 'value', 'items', index );
					    view.addInlineEditingAttributes( item_value, 'basic' );

					    #>
						<li>
							<strong>
								<span {{{ view.getRenderAttributeString( item_label ) }}}>
									{{{ item.label }}}
								</span>
							</strong>
							<span {{{ view.getRenderAttributeString( item_value ) }}}>
								{{{ item.value }}}
							</span>
						</li>
						<# }); #>
					</ul>
				</div>
			</div>
			<# } #>

			<div class="clear"></div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Info_List_Widget() );
