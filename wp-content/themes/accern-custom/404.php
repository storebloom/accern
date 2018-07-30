<?php
/**
 * Template for 404 page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

get_header();
?>
<div class="section-404">
	<div class="section-title">
		<?php echo esc_html__( '404 Error', 'accern-custom' ); ?>
	</div>
	<div class="section-sub-title">
		<?php echo esc_html__( 'Sorry the page you\'re looking for is missing', 'accern-custom' ); ?>
	</div>
	<div class="section-overlay">
		<a class="accern-button red" href="/">
			<?php echo esc_html__( 'Visit Homepage', 'accern-custom' ); ?>
		</a>
	</div>
</div>

<?php
get_footer();
