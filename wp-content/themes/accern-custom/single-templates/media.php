<?php
/**
 * Template for community page media.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$page_meta = get_post_meta( $media->ID, 'page-meta', true );
$author = ! empty( $page_meta['article-fields-section']['author'] ) ? $page_meta['article-fields-section']['author'] : get_the_author( $media->ID );
$thumbnail = get_the_post_thumbnail_url( $media->ID );
$thumbnail = ! empty( $thumbnail ) ? $thumbnail : '';
?>
<div class="media-item">
	<a href="<?php echo esc_url( get_post_permalink( $media->ID ) ); ?>">
		<div class="article-thumbnail">
			<?php if ( '' !== $thumbnail ) : ?>
				<img src="<?php echo esc_url( $thumbnail ); ?>">
			<?php endif; ?>
		</div>
		<div class="article-information">
			<div class="article-date">
				<?php echo 'Posted ' . get_the_date( '', $media->ID ); ?>
			</div>
			<div class="article-title">
				<?php echo esc_html( $media->post_title ); ?>
			</div>
			<div class="article-author">
				<?php echo esc_html__( 'by ', 'accern-custom' ) . esc_html( $author ); ?>
			</div>
		</div>
	</a>
</div>
