<?php
/**
 * Template part for contact page form section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_section_info( 'contact', 'form', get_the_ID() );
?>
<div id="contact-form-section">
	<?php if ( isset( $section_info['title'] ) && '' !== $section_info['title'] ) : ?>
		<div class="section-title">
			<?php echo esc_html( $section_info['title'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['content'] ) && '' !== $section_info['content'] ) : ?>
		<div class="section-content">
			<?php echo wp_kses_post( $section_info['content'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['shortcode'] ) && '' !== $section_info['shortcode'] ) : ?>
		<div class="section-form">
			<?php echo do_shortcode( $section_info['shortcode'] ); ?>
		</div>
	<?php endif; ?>

	<div id="contact-confirmation">
		<div class="thank-you-title"><?php echo esc_html__( 'Thank You!', 'accern-custom' ); ?></div>
		<div class="thank-you-content"><?php echo esc_html__( 'Thank you so much for requesting access. We will be in touch in the next 30 minutes to go over the details with you.', 'accern-custom' ); ?></div>
		<div class="thank-you-cta">
			<a class="accern-button" href="/use-cases"><?php echo esc_html__( 'Explore Case Studies', 'accern-custom' ); ?></a>
		</div>
	</div>
</div>
