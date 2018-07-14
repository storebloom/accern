<?php
/**
 * Template Name: Company
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Pull in main company section.
	get_template_part( 'template-parts/company', 'main' );

	// Pull in team section.
	get_template_part( 'template-parts/company', 'team' );

	// Pull in partner section.
	get_template_part( 'template-parts/company', 'partners' );

	// Pull in overlay wrap.
	get_template_part( 'template-parts/home', 'overlay' );
endwhile; // End of the loop.

get_footer();
