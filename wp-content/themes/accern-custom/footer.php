<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Accern_Custom
 */

// Pull in overlay wrap.
get_template_part( 'template-parts/home', 'overlay' );
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="first-footer-area"><?php dynamic_sidebar( 'footer-1' ); ?></div>
		<div class="second-footer-area"><?php dynamic_sidebar( 'footer-2' ); ?></div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
