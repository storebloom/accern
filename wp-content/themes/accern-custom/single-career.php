<?php
/**
Template Name: Single Career template
Template Post Type: career
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<?php

	$id = get_the_ID();
	$section_info = get_post_meta( $id, 'page-meta', true );
	$section_info = ! empty( $section_info['career-section-accern'] ) ? $section_info['career-section-accern'] : '';

	// Pull in main career section.
	include( get_template_directory() . '/template-parts/career-main.php' );

	// Pull in career content.
	include( get_template_directory() . '/template-parts/career-content.php' );
endwhile; // End of the loop.

get_footer();
