<?php
/**
 * Template part for careers page main section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

?>
<div id="careers-main-section" class="careers-section currently-active-section" style="<?php echo esc_attr( $main_image ); ?>">
	<div class="section-title">
		<?php the_title() ?>
	</div>

	<?php if ( isset( $section_info['sub-title'] ) && '' !== $section_info['sub-title'] ) : ?>
		<div class="section-sub-title">
			<?php echo esc_html( $section_info['sub-title'] ); ?>
		</div>
	<?php endif; ?>

	<div class="section-content">
		<?php the_content(); ?>
	</div>

	<div id="scroll-down-one">Scroll</div>
	<div class="mobile-scroll-buttons">
		<a href="#next-section">
			<span class="mobile-down-arrow"></span>
		</a>
	</div>
</div>
