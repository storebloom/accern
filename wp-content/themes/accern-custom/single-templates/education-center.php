<?php
/**
 * Template for community page education center.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$page_meta = get_post_meta( $education->ID, 'page-meta', true );
$post_author = $education->post_author;
$author = ! empty( $page_meta['article-fields-section']['author'] ) ? $page_meta['article-fields-section']['author'] : get_the_author_meta( 'display_name', $post_author );
$tags = get_the_tags( $education->ID );
?>
<div class="education-center-item">
	<a href="<?php echo esc_url( get_post_permalink( $education->ID ) ); ?>">
		<div class="article-title">
			<?php echo esc_html( $education->post_title ); ?>
		</div>
		<div class="article-author">
			<?php echo esc_html__( 'by ', 'accern-custom' ) . esc_html( $author ); ?>
		</div>
		<?php if ( is_array( $tags ) ) : ?>
			<div class="article-tags">
			    <?php foreach ( $tags as $tag ) : ?>
				    #<?php echo esc_html( $tag->name . ' ' ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="article-post-date">
			<?php
			$orig_time = strtotime( $education->post_date );
			echo esc_html( human_time_diff( $orig_time, current_time( 'timestamp' ) ) . ' ' . __( 'ago' ) );
			?>
		</div>
	</a>
</div>
