<?php
/**
 * Template part for single career main section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

?>
<div id="career-main-section" class="career-section" style="<?php echo esc_attr( $main_image ); ?>">
	<div class="section-title">
		<?php echo esc_html__( 'Careers', 'accern-custom' ); ?>
	</div>
	<div class="section-sub-title">
		<?php the_title(); ?>
	</div>

	<?php if ( ! empty( $section_info['apply-link'] ) ) : ?>
		<div class="section-cta">
			<a href="<?php echo esc_url( $section_info['apply-link'] ); ?>" class="accern-button">
				<?php echo esc_html__( 'Apply Now' ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
