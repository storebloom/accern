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
 * Helper function to retreive page sections data.
 *
 * @param string  $page The page name to get info for.
 * @param string  $section The Section of the page to get info for.
 * @param integer $postid The post id to get info from.
 *
 * @return array
 */
function get_section_info( $page, $section, $postid ) {
	$the_meta = get_post_meta( $postid, 'page-meta', true );

	return $the_meta[ $page . '-' . $section . '-section' ];
}

/**
 * Helper function to get specified page nav icons with page names.
 *
 * @param integer $id The page id to grab info for.
 * @param integer $count How many nav icons to display.
 * @param string  $name The page name icons are for.
 * @param array   $sections An array of section names to use for nav.
 */
function get_accern_nav_icons( $id, $count, $page, $sections ) {
	?>
	<div class="nav-icons">
		<ul>
			<?php
			for ( $x = 1; $x <= $count; $x++ ) :
				$section_num = $x - 1;

				if ( 'homepage' === $page ) {
					$section = get_home_section_info( $sections[ $section_num ], $id );
				} else {
					$section = get_section_info( 'company', $sections[ $section_num ], $id );
				}
				$current = 1 === $x ? 'current-section' : '';
			?>
				<li data-section="<?php echo esc_attr( $x ); ?>" id="section-<?php echo esc_attr( $x ); ?>" class="<?php echo esc_attr( $current ); ?> <?php echo esc_attr( $page ); ?>-nav-section">
					●
					<div class="nav-page-name">
						<?php echo esc_html( $section['title'] ); ?>
					</div>
				</li>
			<?php endfor; ?>
		</ul>
	</div>
<?php
}
