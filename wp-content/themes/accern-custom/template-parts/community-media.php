<?php
/**
 * Template part for community page white papers section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$medias = get_posts(
	array(
		'posts_per_page' => -1,
		'post_type'      => 'post',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array( 'media' ),
			),
		),
	)
);
?>
<div class="community-content" id="community-media">
	<div class="community-title">
		<?php echo esc_html__( 'Our Media', 'accern-custom' ); ?>
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
			<input data-type="media" class="accern-article-search" type="text" placeholder="Search Media">
		</div>
	</div>

	<hr>

	<div class="community-items-list-wrap">
		<?php
		foreach ( $medias as $media ) {
			include( get_template_directory() . '/single-templates/media.php' );
		}
		?>
	</div>
</div>