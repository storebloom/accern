<?php
/**
 * Template Name: Careers
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	$id = get_the_ID();
	$section_info = get_section_info( 'careers', 'main', $id );
	$thumbnail = get_the_post_thumbnail_url( $id );
	$main_image = false !== $thumbnail ? 'background: url(' . $thumbnail . ');' : '';

	// Pull in main careers section.
	include( locate_template( 'template-parts/careers-main.php' ) );

	// Pull in careers page careers section.
	include( locate_template( 'template-parts/careers-careers.php' ) );

endwhile; // End of the loop.

get_footer();
