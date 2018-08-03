<?php
/**
 * Template Name: Contact
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	$id = get_the_ID();
	$main_section_info = get_section_info( 'contact', 'global', $id );
	$thumbnail = get_the_post_thumbnail_url( $id );
	$main_image = false !== $thumbnail ? $thumbnail : '';
	$background = ! empty ( $main_section_info['background-size'] ) && 'full' === $main_section_info['background-size'] ? 'background-image: url(' . $main_image . ');' : '';
	?>
	<div class="contact-wrap" style="<?php echo esc_attr( $background ); ?>" >
	<?php

		// Pull in contact from section.
		include( locate_template( 'template-parts/contact-form.php' ) );

		// Pull in office locations section.
		include( locate_template( 'template-parts/contact-locations.php' ) );
		?>
	</div>
	<?php
endwhile; // End of the loop.

get_footer();
