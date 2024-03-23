<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Products Widget.
 *
 * @since 1.0
 */
class RyanCV_Products_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-products';
	}

	public function get_title() {
		return esc_html__( 'Products', 'ryancv-plugin' );
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
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'ryancv-plugin' ),
					'categories' => __( 'Taxonomy (Categories)', 'ryancv-plugin' ),
					'tags' => __( 'Taxonomy (Tags)', 'ryancv-plugin' ),
					'custom' => __( 'Custom', 'ryancv-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Categories', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_products_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'source_tags',
			[
				'label'       => esc_html__( 'Tags', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_products_tags(),
				'condition' => [
		            'source' => 'tags'
		        ],
			]
		);

		$this->add_control(
			'source_custom',
			[
				'label'       => esc_html__( 'Custom Products', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_products_custom(),
				'condition' => [
		            'source' => 'custom'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'ryancv-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 4,
				'default'     => 4,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
				'options' => [
					'date'  => __( 'Date', 'ryancv-plugin' ),
					'title' => __( 'Title', 'ryancv-plugin' ),
					'rand' => __( 'Random', 'ryancv-plugin' ),
					'menu_order' => __( 'Order', 'ryancv-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC', 'ryancv-plugin' ),
					'desc' => __( 'DESC', 'ryancv-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'buttons_tab',
			[
				'label' => esc_html__( 'Buttons', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'more_btn_txt',
			[
				'label'       => esc_html__( 'Button (title)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'ryancv-plugin' ),
				'default'     => esc_html__( 'All Products', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'more_btn_link',
			[
				'label'       => esc_html__( 'Button (link)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::URL,
				'show_external' => true,
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
					'{{WRAPPER}} .box-item .image .info .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .desc .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .box-item .desc .name',
			]
		);

		$this->add_control(
			'item_category_color',
			[
				'label'     => esc_html__( 'Category Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_category_typography',
				'label'     => esc_html__( 'Category Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .box-item .desc .category',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_products_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'product',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'product_cat',
			'pad_counts'	=> false
		);

		$products_categories = get_categories( $args );

		foreach ( $products_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	protected function get_products_tags() {
		$tags = [];

		$args = array(
			'type'			=> 'product',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'product_tag',
			'pad_counts'	=> false
		);

		$products_tags = get_categories( $args );

		foreach ( $products_tags as $tag ) {
			$tags[$tag->term_id] = $tag->name;
		}

		return $tags;
	}

	protected function get_products_custom() {
		$items = [];

		$args = array(
			'post_type'			=> 'product',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1
		);

		$products_items = new \WP_Query( $args );

		while ( $products_items->have_posts() ) : $products_items->the_post();
			$items[get_the_ID()] = get_the_title();
		endwhile; wp_reset_postdata();

		return $items;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );

		if ( $settings['source'] == 'categories' ) {
			$ids = $settings['source_categories'];
		} elseif ( $settings['source'] == 'tags' ) {
			$ids = $settings['source_tags'];
		} elseif ( $settings['source'] == 'custom' ) {
			$ids = $settings['source_custom'];
		} else {
			$ids = '';
		}

		$args = array(
			'post_type'			=> 'product',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit']
		);

		if ( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'id',
					'terms'    => $ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}
		if ( $settings['source'] == 'tags' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'product_tag',
					'field'    => 'id',
					'terms'    => $ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}
		if ( $settings['source'] == 'custom' ) {
			$args += array( 'post__in' => $ids );
		}

		$products_loop = new \WP_Query( $args );

		?>

		<!-- Products -->
		<div class="content shops woocommerce">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<?php if ( $products_loop->have_posts() ) : ?>
				<!-- content -->
				<ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?> row border-line-v">

					<?php while ( $products_loop->have_posts() ) :
						$products_loop->the_post();
						global $product;
						$product = wc_get_product( get_the_ID() );

						wc_get_template_part( 'content', 'product' );
					endwhile; ?>

					<li class="clear"></li>
				</ul>
			<?php endif; wp_reset_postdata(); ?>
			<?php endif; ?>

			<?php if ( $settings['more_btn_txt'] ) : ?>
			<div class="bts bts-center">
				<a class="button" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>>
					<?php echo esc_html( $settings['more_btn_txt'] ); ?>
				</a>
			</div>
			<?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Products_Widget() );
