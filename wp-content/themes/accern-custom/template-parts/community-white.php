<?php
/**
 * Template part for community page white papers section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$white_papers = get_posts(
	array(
		'posts_per_page' => -1,
		'post_type'      => 'post',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array( 'white-paper' ),
			),
		),
	)
);
?>
<div id="community-white" class="community-content current-community-tab">
	<div class="community-title">
		<?php echo esc_html__( 'White Papers', 'accern-custom' ); ?>
	</div>
	<div class="community-search-wrap">
		<div class="community-count">
		</div>
		<div class="community-sort">
			<ul class="form-select-menu">
				<li data-val="DESC" class="form-select-chosen">Newest</li>
				<li data-val="DESC">Newest</li>
				<li data-val="ASC">Oldest</li>
			</ul>
		</div>
		<div class="community-search">
			<input data-type="white" class="accern-article-search" type="text" placeholder="Search White Papers">
		</div>
	</div>

	<hr>

	<div class="community-items-list-wrap">
		<?php
		foreach ( $white_papers as $white ) {
			include( get_template_directory() . '/single-templates/white-paper.php' );
		}
		?>
	</div>
	<input type="hidden" id="download-this-one">

	<?php if ( ! empty( $section_info['form-shortcode'] ) ) : ?>
		<div class="accern-overlay-content-wrap-white">
			<div class="accern-overlay-content-wrap-inner">
				<span id="close-overlay" class="overlay-icon"><i>Close</i></span>
				<div class="accern-overlay-content">
					<div class="overlay-title">
						<?php echo esc_html__( 'White Paper Access', 'accern-custom' ); ?>
					</div>
					<div class="overlay-content">
						<?php echo do_shortcode( $section_info['form-shortcode'] ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
