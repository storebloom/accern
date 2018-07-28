<?php
/**
 * Template part for single career content section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

?>
<div id="career-content-section" class="career-section">
	<div class="section-content">
		<?php the_content() ?>
	</div>
</div>

<?php if ( ! empty( $section_info['apply-link'] ) ) : ?>
	<div class="section-cta">
		<a href="<?php echo esc_url( $section_info['apply-link'] ); ?>" class="accern-button">
			<?php echo esc_html__( 'Apply Now' ); ?>
		</a>
	</div>
<?php endif; ?>

