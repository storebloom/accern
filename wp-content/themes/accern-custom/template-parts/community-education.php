<?php
/**
 * Template part for community page education center section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$education_centers = get_posts(
	array(
		'posts_per_page' => -1,
		'post_type'      => 'post',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array( 'education-center' ),
			),
		),
	)
);
?>
<div class="community-content" id="community-education">
	<div class="community-title">
		<?php echo esc_html__( 'Education Center', 'accern-custom' ); ?>
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
			<input data-type="education" class="accern-article-search" type="text" placeholder="Search Education Center">
		</div>
	</div>

	<hr>

	<div class="community-items-list-wrap">
		<?php
		foreach ( $education_centers as $education ) {
			include( get_template_directory() . '/single-templates/education-center.php' );
		}
		?>
	</div>
</div>