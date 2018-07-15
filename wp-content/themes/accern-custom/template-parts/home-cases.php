<?php
/**
 * Template part for home page use cases section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_home_section_info( 'cases', get_the_ID() );
?>
<div id="home-section-cases">
	<?php if ( isset( $section_info['title'] ) && '' !== $section_info['title'] ) : ?>
		<div class="section-title">
			<?php echo esc_html( $section_info['title'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $section_info['link-repeater'][1]['title'] ) && is_array( $section_info['link-repeater'] ) ) : ?>
		<?php foreach ( $section_info['link-repeater'] as $num => $link ) : ?>
			<div class="home-case-link-wrap">
				<a href="<?php echo esc_url( $link['url'] ); ?>" class="home-case-link">
					<?php echo esc_html( $link['title'] ); ?>
				</a>
			</div>
	<?php
		endforeach;
	endif;
	?>
</div>