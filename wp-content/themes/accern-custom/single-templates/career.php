<?php
/**
 * Template for careers page career.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$categories = wp_get_post_terms( $career->ID, 'department' );
?>
<div class="career-item">
	<a href="<?php echo esc_url( get_post_permalink( $career->ID ) ); ?>">
		<div class="article-subcat">
			<?php echo esc_html( $categories[0]->name ); ?>
		</div>
		<div class="article-title">
			<?php echo esc_html( $career->post_title ); ?>
		</div>
		<div class="learn-more-link">
			<?php echo esc_html__( 'Learn More', 'accern-custom' ); ?>
		</div>
	</a>
</div>
