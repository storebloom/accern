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
endwhile; // End of the loop.

get_footer();
