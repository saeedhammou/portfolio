<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ryancv
 */

?>

		</div>
	</div>

	<?php wp_footer(); ?>

	<?php
		$ryan_cursor = get_field( 'ryan_cursor', 'options' );
		$footer_content = get_field( 'footer_content', 'options' );
	?>

	<?php if ( $ryan_cursor == 0 ) : ?>
	<!-- cursor -->
	<div class="cursor"></div>
	<?php endif; ?>

	<?php if ( $footer_content ) : ?>
	<!-- custom footer -->
	<div class="custom-footer">
		<?php echo wp_kses_post( $footer_content ); ?>
	</div>
	<?php endif; ?>

</body>
</html>
