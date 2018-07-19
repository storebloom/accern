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

	// Pull in overlay wrap.
	get_template_part( 'template-parts/home', 'overlay' );

	// Nav icons.
	$id = get_the_ID();
	$section1 = get_home_section_info( '1', $id );
	$section2 = get_home_section_info( '2', $id );
	$section3 = get_home_section_info( '3', $id );
	$section4 = get_home_section_info( '4', $id );
	$section5 = get_home_section_info( '5', $id );
	$section6 = get_home_section_info( 'cases', $id );
	?>
	<div class="nav-icons">
		<ul>
			<li data-section="1" id="section-1" class="current-section home-nav-section">
				●
				<div class="nav-page-name">
					<?php echo esc_html( $section1['title'] ); ?>
				</div>
			</li>
			<li data-section="2" id="section-2" class="home-nav-section">
				●
				<div class="nav-page-name">
					<?php echo esc_html( $section2['title'] ); ?>
				</div>
			</li>
			<li data-section="3" id="section-3" class="home-nav-section">
				●
				<div class="nav-page-name">
					<?php echo esc_html( $section3['title'] ); ?>
				</div>
			</li>
			<li data-section="4" id="section-4" class="home-nav-section">
				●
				<div class="nav-page-name">
					<?php echo esc_html( $section4['title'] ); ?>
				</div>
			</li>
			<li data-section="5" id="section-5" class="home-nav-section">
				●
				<div class="nav-page-name">
					<?php echo esc_html( $section5['title'] ); ?>
				</div>
			</li>
			<li data-section="6" id="section-6" class="home-nav-section">
				●
				<div class="nav-page-name">
					<?php echo esc_html( $section6['title'] ); ?>
				</div>
			</li>
		</ul>
	</div>
	<?php
endwhile; // End of the loop.

get_footer();
