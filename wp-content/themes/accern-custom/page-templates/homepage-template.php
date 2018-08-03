<?php
/**
 * Template Name: Homepage
 *
 * @package Accern_Custom
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div id="home-page-animations"></div>
	<?php
	// Set for 5 sections.  Change integer to add or remove sections.
	for ( $x = 0; $x <= 5; $x++ ) {
		get_template_part( 'template-parts/home', (string) $x );
	}

	// Pull in use cases link list section.
	get_template_part( 'template-parts/home', 'cases' );

	// Nav icons.
	$id = get_the_ID();

	get_accern_nav_icons( $id, 6, 'homepage', array( 'Behind Great Decisions', 'Content Aggregation', 'Content Filtering', 'Content Analysis', 'Decision-Making', 'Our Use Cases' ), true );
endwhile; // End of the loop.

get_footer();
