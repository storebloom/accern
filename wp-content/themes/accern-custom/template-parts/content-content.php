<?php
/**
 * Template part for displaying post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

?>

<article id="post-<?php the_ID(); ?>" class="next-section">
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article>
