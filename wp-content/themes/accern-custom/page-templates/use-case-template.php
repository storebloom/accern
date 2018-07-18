<?php
/**
 * Template Name: Use Cases
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Pull in main use case section.
	get_template_part( 'template-parts/usecase', 'main' );

	// Pull in use cases.
	get_template_part( 'template-parts/usecase', 'cases' );
endwhile; // End of the loop.

get_footer();
