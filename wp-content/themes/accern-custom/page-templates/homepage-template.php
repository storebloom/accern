<?php
/**
 * Template Name: Homepage
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/home', '1' );
endwhile; // End of the loop.

get_footer();
