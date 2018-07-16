<?php
/**
 * Template part for community page white papers section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$posts = get_posts(
	array(
		'posts_per_page' => 100,
		'post_type'      => 'post',
		
	)
);
?>
<div id="community-white-papers">
	<div class="community-title">
		<?php echo esc_html__( 'White Papers', 'accern-custom' ); ?>
	</div>
	<div class="community-count">
		<div class="count-number"></div>
		<?php echo esc_html__( ' Results Showing', 'accern-custom' ); ?>
	</div>
	<div class="community-sort">
		<select id="sort-community-items">
			<option value="asc"><?php echo esc_html__( 'Newest', 'accern-custom' ); ?></option>
			<option value="desc"><?php echo esc_html__( 'Oldest', 'accern-custom' ); ?></option>
		</select>
	</div>
	<div class="community-search">
		<input type="text" placeholder="Search White Papers">
	</div>
	<div class="community-items-list-wrap">
	</div>
</div>