<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<?php

	// Pull in main article section.
	get_template_part( 'template-parts/content', 'main' );

	// Pull in article content.
	get_template_part( 'template-parts/content', 'content' );
endwhile; // End of the loop.

get_footer();
