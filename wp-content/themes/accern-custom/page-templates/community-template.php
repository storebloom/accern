<?php
/**
 * Template Name: Community
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Pull in main community section.
	get_template_part( 'template-parts/community', 'main' );

	// Pull in white papers community section.
	get_template_part( 'template-parts/community', 'white' );

	// Pull in education center community section.
	get_template_part( 'template-parts/community', 'education' );

	// Pull in media community section.
	get_template_part( 'template-parts/community', 'media' );
endwhile; // End of the loop.

get_footer();
