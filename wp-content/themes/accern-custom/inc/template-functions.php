<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Accern_Custom
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function accern_custom_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'accern_custom_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function accern_custom_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'accern_custom_pingback_header' );

/**
 * Helper function to retreive homepage sections data.
 *
 * @param $section
 * @param $postid
 *
 * @return array
 */
function get_home_section_info( $section, $postid ) {
	$home_meta = get_post_meta( $postid, 'page-meta', true );

	return $home_meta[ 'home-section-' . $section ];
}

/**
 * Helper function to retreive company page sections data.
 *
 * @param $section
 * @param $postid
 *
 * @return array
 */
function get_company_section_info( $section, $postid ) {
	$company_meta = get_post_meta( $postid, 'page-meta', true );

	return $company_meta[ 'company-' . $section . '-section' ];
}
