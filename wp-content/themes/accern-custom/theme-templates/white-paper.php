<?php
/**
 * Template for community page white paper.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$download_file = get_post_meta( $white->ID, 'page-meta', true );
$categories = wp_get_post_terms( $white->ID, 'category' );
?>
<div class="white-paper-item">
	<div class="article-subcat">
		<?php echo esc_html( $categories[0]->name ); ?>
	</div>
	<div class="article-title">
		<?php echo esc_html( $white->post_title ); ?>
	</div>
	<div class="article-content">
		<?php echo esc_html( $white->post_content ); ?>
	</div>
	<div class="download-file">
		<span class="download-icon"></span>

		<?php if ( ! empty( $download_file['article-fields-section']['file'] ) ) : ?>
			<a href="<?php echo esc_url( $download_file['article-fields-section']['file'] ); ?>">
		<?php endif; ?>

		<?php echo esc_html__( 'Download Paper', 'accern-custom' ); ?>

		<?php if ( ! empty( $download_file['article-fields-section']['file'] ) ) : ?>
			</a>
		<?php endif; ?>
	</div>
</div>
