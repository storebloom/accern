<?php
/**
 * Template part for home page section 5
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_home_section_info( '5', get_the_ID() );
?>
<div id="home-section-5">
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

	<?php if ( ! empty( $section_info['overlay-repeater'][1]['title'] ) && is_array( $section_info['overlay-repeater'] ) ) : ?>
		<?php foreach ( $section_info['overlay-repeater'] as $num => $overlay_links ) : ?>
			<?php if ( ! empty( $overlay_links['url'] ) ) : ?>
				<div class="section-cta">
					<a href="<?php echo esc_url( $overlay_links['url'] ); ?>" class="accern-button">
						<?php echo esc_html( $overlay_links['title'] ); ?>
					</a>
				</div>
			<?php else : ?>
				<div class="section-overlay">
					<a class="accern-overlay-button" data-section="home-section-5" data-num="<?php echo esc_attr( $num ); ?>" id="section-5-overlay-<?php echo esc_attr( $num ); ?>">
						<?php echo esc_html( $overlay_links['title'] ); ?>
					</a>
				</div>
				<?php
			endif;
		endforeach;
	endif;
	?>
</div>
