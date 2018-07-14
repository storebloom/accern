<?php
/**
 * Template Name: Homepage
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Set for 5 sections.  Change integer to add or remove sections.
	for ( $x = 0; $x <= 5; $x++ ) {
		get_template_part( 'template-parts/home', (string) $x );
	}

	// Pull in use cases link list section.
	get_template_part( 'template-parts/home', 'cases' );

	// Pull in overlay wrap.
	get_template_part( 'template-parts/home', 'overlay' );
endwhile; // End of the loop.

get_footer();
