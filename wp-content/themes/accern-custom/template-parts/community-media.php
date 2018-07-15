<?php
/**
 * Template part for community page white papers section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */


?>
<div id="community-media">
	<div class="community-title">
		<?php echo esc_html__( 'Our Media', 'accern-custom' ); ?>
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
		<input type="text" placeholder="Search Media">
	</div>
	<div class="community-items-list-wrap">
	</div>
</div>