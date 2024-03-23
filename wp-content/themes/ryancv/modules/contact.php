<?php
	$title = get_sub_field( 'title' );
	$title_seo = get_sub_field( 'title_seo' );
	$map = get_sub_field( 'map' );
	$disable_map = get_sub_field( 'disable_map' );
	$fields = get_sub_field( 'items' );
	$section_id = get_sub_field( 'section_id' );

	$disable_api = get_field( 'disable_api', 'options' );
?>

<!--
	Conacts Info
-->
<div class="content contacts">

	<?php if ( $title ) : ?>
	<!-- title -->
	<<?php echo esc_attr( $title_seo ); ?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_seo ); ?>>
	<?php endif; ?>

	<!-- content -->
	<div class="row">
		<div class="col col-d-12 col-t-12 col-m-12 border-line-v">
			<?php if ( ! empty( $map ) ) : ?>
			<div class="map acf-map<?php if ( $disable_map == 1 || $disable_api == 1 ) : ?> hide-map<?php endif; ?>">
				<div class="marker" data-lat="<?php echo esc_attr( $map['lat'] ); ?>" data-lng="<?php echo esc_attr( $map['lng'] ); ?>"></div>
			</div>
			<?php endif; ?>

			<?php if ( $fields ) : ?>
			<div class="info-list">
				<ul>
					<?php foreach ( $fields as $item ) { ?>
					<li>
						<strong><?php echo esc_html( $item['label'] ); ?><?php echo esc_html__( ':', 'ryancv' ); ?></strong> 
						<?php echo wp_kses_post( $item['value'] ); ?>
					</li>
					<?php } ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

</div>