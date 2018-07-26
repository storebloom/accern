<?php
/**
 * Template Name: Community
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();

	$id = get_the_ID();
	$section_info = get_section_info( 'community', 'main', $id );
	$thumbnail = get_the_post_thumbnail_url( $id );
	$main_image = false !== $thumbnail ? 'background: url(' . $thumbnail . ');' : '';

	// Pull in main community section.
	include( locate_template( 'template-parts/community-main.php' ) );

	// Pull in white papers community section.
	get_template_part( 'template-parts/community', 'white' );

	// Pull in education center community section.
	get_template_part( 'template-parts/community', 'education' );

	// Pull in media community section.
	get_template_part( 'template-parts/community', 'media' );
endwhile; // End of the loop.

get_footer();
