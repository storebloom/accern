<?php
/**
 * Template part for home page section 2
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_home_section_info( '2', get_the_ID() );
?>
<div id="home-section-2">
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

	<?php if ( ! empty( $section_info['overlay-repeater'][1]['content'] ) && is_array( $section_info['overlay-repeater'] ) ) : ?>
		<?php foreach ( $section_info['overlay-repeater'] as $num => $overlay_links ) : ?>
			<div class="section-overlay">
				<a class="accern-overlay-button" data-section="2" data-num="<?php echo esc_attr( $num ); ?>" id="section-2-overlay-<?php echo esc_attr( $num ); ?>">
					<img class="overlay-icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/overlay-icon.png' ); ?>">
					<?php echo esc_html( $overlay_links['title'] ); ?>
				</a>
			</div>
		<?php
		endforeach;
	endif; ?>

	<?php if ( isset( $section_info['cta-url'] ) && '' !== $section_info['cta-url'] ) : ?>
		<div class="section-cta">
			<a href="<?php echo esc_url( $section_info['cta-url'] ); ?>" class="accern-button">
				<?php echo esc_html( $section_info['cta-text'] ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
