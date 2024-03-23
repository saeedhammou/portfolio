<?php
/**
 * Template part for displaying elementor page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ryancv
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
</div><!-- #post-<?php the_ID(); ?> -->