<?php
/**
 * Template part for contact page locations section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_section_info( 'contact', 'locations', get_the_ID() );
$background = ! empty ( $main_section_info['background-size'] ) && 'half' === $main_section_info['background-size'] ? 'background-image: url(' . $main_image . ');' : '';
?>
<div id="contact-locations-section" style="<?php echo esc_attr( $background ); ?>">
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

	<?php if ( ! empty( $section_info['wysiwyg-repeater'][1]['content'] ) && is_array( $section_info['wysiwyg-repeater'] ) ) : ?>
		<?php foreach ( $section_info['wysiwyg-repeater'] as $num => $location ) : ?>
			<div class="location-wrap">
				<?php echo wp_kses_post( $location['content'] ); ?>
			</div>
			<?php
		endforeach;
	endif;
	?>
</div>
