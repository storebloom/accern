<?php
/**
 * Template Name: Use Cases
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	$id = get_the_ID();
	$section_info = get_section_info( 'usecase', 'main', $id );

	// Pull in main use case section.
	include( locate_template( 'template-parts/usecase-main.php' ) );

	// Pull in use cases.
	include( locate_template( 'template-parts/usecase-cases.php' ) );
endwhile; // End of the loop.

get_footer();
