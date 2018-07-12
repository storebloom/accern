<?php
/**
 * Template part for home page section 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_home_section_info( '1', get_the_ID() );
?>
<div id="home-section-1">
	<?php if ( isset( $section_info['title'] ) && '' !== $section_info['title'] ) : ?>
	<div class="section-title">
		<?php echo esc_html( $section_info['title'] ); ?>
	</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['sub-title'] ) && '' !== $section_info['sub-title'] ) : ?>
	<div class="section-sub-title">
		<?php echo esc_html( $section_info['sub-title'] ); ?>
	</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['cta-url'] ) && '' !== $section_info['cta-url'] ) : ?>
	<div class="section-cta">
		<a href="<?php echo esc_url( $section_info['cta-url'] ); ?>" class="accern-button">
			<?php echo esc_html( $section_info['cta-text'] ); ?>
		</a>
	</div>
	<?php endif; ?>
</div>
