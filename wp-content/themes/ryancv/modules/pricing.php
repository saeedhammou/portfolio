<?php
	$title = get_sub_field( 'title' );
	$title_seo = get_sub_field( 'title_seo' );
	$pricing = get_sub_field( 'items' );
?>

<!--
	Price Tables
-->
<div class="content pricing">

	<?php if ( $title ) : ?>
	<!-- title -->
	<<?php echo esc_attr( $title_seo ); ?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_seo ); ?>>
	<?php endif; ?>

	<?php if ( $pricing ) : ?>
	<!-- content -->
	<div class="row pricing-items">

		<?php foreach ( $pricing as $item ) { ?>
		<!-- pricing item -->
		<div class="col col-d-6 col-t-6 col-m-12 border-line-v">
			<div class="pricing-item">
				<?php if ( ! $item['img'] ) : ?><div class="icon"><i class="ion <?php echo esc_attr( $item['icon'] ); ?>"></i></div><?php endif; ?>
				<?php if ( $item['img'] ) : ?>
				<?php $img = $item['img']; if( $img ) : ?>
					<div class="icon-img" style="background-image: url(<?php echo esc_url( $img['sizes']['ryancv_140x140'] ); ?>);"></div>
				<?php endif; ?>
				<?php endif; ?>
				<div class="name"><?php echo esc_html( $item['name'] ); ?></div>
				<div class="amount">
					<span class="dollar"><?php echo esc_html( $item['price']['before'] ); ?></span>
					<span class="number"><?php echo esc_html( $item['price']['value'] ); ?></span>
					<span class="period"><?php echo esc_html( $item['price']['after'] ); ?></span>
				</div>
				<?php if ( $item['list'] ) : ?>
				<div class="feature-list">
					<ul>
						<?php foreach ( $item['list'] as $row ) { ?>
						<li <?php if ( $row['line'] ) : ?>class="disable"<?php endif; ?>>
							<?php echo esc_html( $row['text'] ); ?> 
							<?php if ( $row['new'] ) : ?>
							<strong><?php echo esc_html__( 'new', 'ryancv' ); ?></strong>
							<?php endif; ?>
						</li>
						<?php } ?>
					</ul>
				</div>
				<?php endif; ?>
				<div class="lnks">
					<a href="<?php echo esc_url( $item['button']['url'] ); ?>" class="lnk">
						<span class="text"><?php echo esc_html( $item['button']['label'] ); ?></span>
						<i class="ion <?php echo esc_attr( $item['icon'] ); ?>"></i>
					</a>
				</div>
			</div>
		</div>
		<?php } ?>

		<div class="clear"></div>
	</div>
	<?php endif; ?>

</div>