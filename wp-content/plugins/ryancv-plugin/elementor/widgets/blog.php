<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RyanCV Blog Widget.
 *
 * @since 1.0
 */
class RyanCV_Blog_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-blog';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'ryancv-plugin' );
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
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Filters show only with pagination: "Load More", "Custom Button" or "No"', 'ryancv-plugin' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'ryancv-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ryancv-plugin' ),
				'label_off' => __( 'Hide', 'ryancv-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
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
					'categories' => __( 'Categories', 'ryancv-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_blog_categories(),
				'condition' => [
		            'source' => 'categories'
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
				'default' => 'date',
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
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'ryancv-plugin' ),
					'desc' => __( 'DESC', 'ryancv-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination_tab',
			[
				'label' => esc_html__( 'Pagination', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'       => esc_html__( 'Pagination Type', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'loadmore',
				'options' => [
					'0' => __( 'No', 'ryancv-plugin' ),
					'loadmore' => __( 'Load More', 'ryancv-plugin' ),
					'2' => __( 'Custom Button', 'ryancv-plugin' ),
					'1' => __( 'Pages (without filters)', 'ryancv-plugin' ),
					'scroll' => __( 'Infinite Scrolling (without filters)', 'ryancv-plugin' ),
				],
			]
		);

		$this->add_control(
			'load_more_btn_txt',
			[
				'label'       => esc_html__( 'Button (label)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Load More', 'ryancv-plugin' ),
				'condition' => [
		            'pagination' => 'loadmore'
		        ],
			]
		);

		$this->add_control(
			'more_btn_txt',
			[
				'label'       => esc_html__( 'Button (title)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'ryancv-plugin' ),
				'default'     => esc_html__( 'All Posts', 'ryancv-plugin' ),
				'condition' => [
		            'pagination' => '2'
		        ],
			]
		);

		$this->add_control(
			'more_btn_link',
			[
				'label'       => esc_html__( 'Button (link)', 'ryancv-plugin' ),
				'type'        => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'pagination' => '2'
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
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'ryancv-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_date_color',
			[
				'label'     => esc_html__( 'Date Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .box-item .date' => 'border-color: {{VALUE}};',
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
			'item_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .desc .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_text_typography',
				'label'     => esc_html__( 'Text Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .box-item .desc .text',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_blog_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false
		);

		$blog_categories = get_categories( $args );

		foreach ( $blog_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );

		$page_id = get_the_ID();

		$blog_slug = '#' . get_post_field( 'post_name', get_post() );

		if ( $settings['limit'] ) {
			$posts_per_page = $settings['limit'];
		} else {
			$posts_per_page = get_option( 'posts_per_page' );
		}

		if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}

		$posts = wp_count_posts( 'post' );
		$total_posts = $posts->publish;

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$bf_categories = get_categories( $cat_args );

		$args = array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
		);

		if( $settings['source'] == 'categories' ) {
			$args['cat'] = $cat_ids;
		}

		$q = new \WP_Query( $args );

		?>

		<!-- Blog -->
		<div class="content works blog-grid blog">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( $settings['filters'] && $bf_categories && ( $settings['pagination'] == '0' || $settings['pagination'] == '2' || $settings['pagination'] == 'loadmore' ) ) : ?>
			<!-- filters -->
			<div class="filter-menu filter-button-group">
				<div class="f_btn active">
					<label><input type="radio" name="fl_radio" value=".grid-item" /><?php echo esc_html__( 'All', 'ryancv-plugin' ); ?></label>
				</div>
				<?php foreach ( $bf_categories as $category ) : ?>
				<div class="f_btn">
					<label><input type="radio" name="fl_radio" data-cat-id="<?php echo esc_attr( $category->term_id ); ?>" value=".bf-<?php echo esc_attr( $category->slug ); ?>" /><?php echo esc_html( $category->name ); ?></label>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( $q->have_posts() ) : ?>
				<!-- content -->
				<div class="row grid-items border-line-v">

					<?php
					/* Start the Loop */
					while ( $q->have_posts() ) :
						$q->the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;
					?>

					<div class="clear"></div>
				</div>

				<?php if ( $settings['pagination'] == '1' ) : ?>
				<div class="pager">
					<nav class="navigation pagination" role="navigation">
						<div class="nav-links">

						<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, $paged ),
								'total' => $q->max_num_pages,
								'prev_text' => esc_html__( 'Prev', 'ryancv-plugin' ),
								'next_text' => esc_html__( 'Next', 'ryancv-plugin' ),
								'show_all'     => false,
								'end_size'     => 1,
								'mid_size'     => 1,
								'prev_next'    => true,
								'add_args'     => false,
								'add_fragment' => $blog_slug,
							) );
						?>

						</div>
					</nav>
				</div>
				<?php endif; ?>

				<?php if ( $settings['pagination'] == '2' && $settings['more_btn_link'] ) : ?>
				<div class="bts bts-center">
					<a class="lnk button" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>><?php echo esc_html( $settings['more_btn_txt'] ); ?></a>
				</div>
				<?php endif; ?>

				<?php if ( $settings['pagination'] == 'scroll' ) :
				$infinite_scrolling_data = array(
					'url'   => admin_url( 'admin-ajax.php' ),
					'max_num' => $q->max_num_pages,
					'page_id' => $page_id,
					'order_by' => $settings['sort'],
					'order' => $settings['order'],
					'per_page' => $settings['limit'],
					'source' => $settings['source'],
					'temp' => 'content',
					'cat_ids' => $cat_ids
				);

				wp_enqueue_script( 'ryancv-blog-infinite-scroll-el', get_template_directory_uri() . '/assets/js/blog-infinite-scroll-el.js', array( 'jquery' ), '1.0', true );
				wp_localize_script( 'ryancv-blog-infinite-scroll-el', 'ajax_blog_infinite_scroll_data', $infinite_scrolling_data );
			?>
			<?php endif; ?>

			<?php if ( $settings['pagination'] == 'loadmore' ) :
				$infinite_scrolling_data = array(
					'url'   => admin_url( 'admin-ajax.php' ),
					'max_num' => $q->max_num_pages,
					'page_id' => $page_id,
					'order_by' => $settings['sort'],
					'order' => $settings['order'],
					'per_page' => $settings['limit'],
					'source' => $settings['source'],
					'temp' => '',
					'cat_ids' => $cat_ids
				);

				wp_enqueue_script( 'ryancv-blog-load-more-el', get_template_directory_uri() . '/assets/js/blog-load-more-el.js', array( 'jquery' ), '1.0', true );
				wp_localize_script( 'ryancv-blog-load-more-el', 'ajax_blog_infinite_scroll_data', $infinite_scrolling_data );
			?>
			<div class="bts bts-center">
				<a class="lnk button load-more" href="#"><?php echo esc_html( $settings['load_more_btn_txt'] ); ?></a>
			</div>
			<?php endif; ?>

			<?php else :
				get_template_part( 'template-parts/content', 'none' );
			endif;

			wp_reset_postdata();

			?>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new RyanCV_Blog_Widget() );
