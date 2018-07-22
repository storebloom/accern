<?php
/**
 * Template part for company page main section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_section_info( 'company', 'main', get_the_ID() );
?>
<div data-section="1" id="company-main-section" class="company-section">
	<?php if ( isset( $section_info['title'] ) && '' !== $section_info['title'] ) : ?>
		<?php if ( wp_is_mobile() ) : ?>
			<a name="<?php echo esc_attr( $section_info['title'] ); ?>"></a>
		<?php endif; ?>

		<div class="section-title">
			<?php echo esc_html( $section_info['title'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['sub-title'] ) && '' !== $section_info['sub-title'] ) : ?>
		<div class="section-sub-title">
			<?php echo esc_html( $section_info['sub-title'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['content'] ) && '' !== $section_info['content'] ) : ?>
		<div class="section-content">
			<?php echo wp_kses_post( $section_info['content'] ); ?>
		</div>
	<?php endif; ?>

	<div id="scroll-down-one">Scroll</div>
	<div class="mobile-scroll-buttons">
		<span class="mobile-down-arrow"></span>
	</div>
</div>
