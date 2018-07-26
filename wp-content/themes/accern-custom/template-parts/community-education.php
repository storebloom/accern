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
	<div class="community-count">
	</div>
	<div class="community-sort">
		<select id="sort-community-items">
			<option value="DESC"><?php echo esc_html__( 'Newest', 'accern-custom' ); ?></option>
			<option value="ASC"><?php echo esc_html__( 'Oldest', 'accern-custom' ); ?></option>
		</select>
	</div>
	<div class="community-search">
		<input data-type="education" class="accern-article-search" type="text" placeholder="Search Education Center">
	</div>
	<div class="community-items-list-wrap">
		<?php
		foreach ( $education_centers as $education ) {
			include( get_template_directory() . '/single-templates/education-center.php' );
		}
		?>
	</div>
</div>