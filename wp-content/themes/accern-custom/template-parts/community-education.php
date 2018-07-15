<?php
/**
 * Template part for community page education center section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */


?>
<div id="community-education-center">
	<div class="community-title">
		<?php echo esc_html__( 'Education Center', 'accern-custom' ); ?>
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
		<input type="text" placeholder="Search Education Center">
	</div>
	<div class="community-items-list-wrap">
	</div>
</div>