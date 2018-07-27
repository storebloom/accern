<?php
/**
 * Template part for community page main section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

?>
<div class="currently-active-section community-section" id="community-main-section" style="<?php echo esc_attr( $main_image ); ?>">
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
					<a class="accern-overlay-button" data-section="community-main-section" data-num="<?php echo esc_attr( $num ); ?>" id="community-main-overlay-<?php echo esc_attr( $num ); ?>">
						<?php echo esc_html( $overlay_links['title'] ); ?>
					</a>
				</div>
				<?php
			endif;
		endforeach;
	endif;
	?>
	<div id="scroll-down-one">Scroll</div>
	<div class="mobile-scroll-buttons">
		<a href="#next-section">
			<span class="mobile-down-arrow"></span>
		</a>
	</div>
</div>
<div class="community-tab-wrapper next-section">
	<ul>
		<li data-tab="community-white" class="active-tab"><?php echo esc_html__( 'White Papers', 'accern-custom' ); ?></li>
		<li data-tab="community-education"><?php echo esc_html__( 'Education Center', 'accern-custom' ); ?></li>
		<li data-tab="community-media"><?php echo esc_html__( 'Media', 'accern-custom' ); ?></li>
	</ul>
</div>
