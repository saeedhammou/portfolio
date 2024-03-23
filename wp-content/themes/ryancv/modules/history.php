<?php
	$title = get_sub_field( 'title' );
	$title_seo = get_sub_field( 'title_seo' );
	$items = get_sub_field( 'items' );
	$section_id = get_sub_field( 'section_id' );
?>

<!--
	Resume
-->
<div class="content resume">

	<?php if ( $title ) : ?>
	<!-- title -->
	<<?php echo esc_attr( $title_seo ); ?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_seo ); ?>>
	<?php endif; ?>

	<?php if ( $items ) : ?>
	<!-- content -->
	<div class="row">
		<?php 
			$col_count = count( $items );
			$col_class = 'col col-d-12 col-t-12 col-m-12';

			if( $col_count > 1 ) {
				$col_class = 'col col-d-6 col-t-6 col-m-12';
			}
		?>

		<?php foreach ( $items as $item ) { ?>
		<!-- experience -->
		<div class="<?php echo esc_attr( $col_class ); ?> border-line-v">
			<?php if ( $item['name'] ) : ?>
			<div class="resume-title border-line-h">
				<?php if( $item['icon'] != 'ion-none' && $item['icon'] ) : ?>
				<div class="icon"><i class="ion <?php echo esc_attr( $item['icon'] ); ?>"></i></div>
				<?php endif; ?>
				<?php if( $item['name'] ) : ?>
				<div class="name"><?php echo esc_html( $item['name'] ); ?></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php
			$fields = $item['fields'];
			if ( $fields ) :
			?>
			<div class="resume-items">
				<?php foreach ( $fields as $field ) { ?>
				<div class="resume-item border-line-h <?php if ( $field['active'] ) : ?>active<?php endif; ?>">
					<?php if ( $field['image'] ) : ?><div class="image"><a class="has-popup-image" href="<?php echo esc_url( $field['image'] ); ?>"><img src="<?php echo esc_url( $field['image'] ); ?>" alt="<?php echo esc_attr( $field['title'] ); ?>" /></a></div><?php endif; ?>
					<div class="date"><?php echo esc_html( $field['years'] ); ?></div>
					<div class="name"><?php echo esc_html( $field['title'] ); ?></div>
					<div class="company"><?php echo esc_html( $field['subtitle'] ); ?></div>
					<div class="single-post-text"><?php echo wp_kses_post( $field['text'] ); ?></div>
				</div>
				<?php } ?>
			</div>
			<?php endif; ?>
		</div>
		<?php } ?>

		<div class="clear"></div>
	</div>
	<?php endif; ?>

</div>