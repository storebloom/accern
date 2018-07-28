<?php
/**
 * Template part for main section for articles.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */


$categories = get_the_category();
$category = $categories[0]->name;
$post_meta = get_post_meta( get_the_ID(), 'page-meta', true );
$publisher = ! empty( $post_meta['article-fields-section'] ) && isset( $post_meta['article-fields-section']['publisher'] ) ? $post_meta['article-fields-section']['publisher'] : '';
$author = ! empty( $post_meta['article-fields-section'] ) && isset( $post_meta['article-fields-section']['author'] ) ? $post_meta['article-fields-section']['author'] : get_the_author();
$thumbnail = get_the_post_thumbnail_url( $id );
$main_image = false !== $thumbnail ? 'background: url(' . $thumbnail . ');' : '';
?>
<div data-section="1" id="article-main-section" class="article-section currently-active-section" style="<?php echo esc_attr( $main_image ); ?>">
	<div class="section-title">
		<?php echo esc_html( $category ); ?>
	</div>

	<div class="section-sub-title">
		<?php the_title(); ?>
	</div>

	<?php if ( '' !== $publisher ) : ?>
		<div class="section-publisher">
			<?php echo esc_html( $publisher ); ?>
		</div>
	<?php endif; ?>

	<div class="section-author">
		<?php echo esc_html__( 'Written by: ', 'accern-custom' ) . esc_html( $author ); ?>
	</div>

	<div id="scroll-down-one">Scroll</div>
	<div class="mobile-scroll-buttons">
		<a href="#next-section">
			<span class="mobile-down-arrow"></span>
		</a>
	</div>
</div>
