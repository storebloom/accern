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
	<div class="community-count">
	</div>
	<div class="community-sort">
		<select id="sort-community-items">
			<option value="DESC"><?php echo esc_html__( 'Newest', 'accern-custom' ); ?></option>
			<option value="ASC"><?php echo esc_html__( 'Oldest', 'accern-custom' ); ?></option>
		</select>
	</div>
	<div class="community-search">
		<input data-type="media" class="accern-article-search" type="text" placeholder="Search Media">
	</div>
	<div class="community-items-list-wrap">
		<?php
		foreach ( $medias as $media ) {
			include( get_template_directory() . '/theme-templates/media.php' );
		}
		?>
	</div>
</div>