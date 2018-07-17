<?php
/**
 * Template Name: Contact
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Pull in contact from section.
	get_template_part( 'template-parts/contact', 'form' );

	// Pull in office locations section.
	get_template_part( 'template-parts/contact', 'locations' );
endwhile; // End of the loop.

get_footer();
