<?php
/**
 * Template part for careers page careers section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$careers = get_posts(
	array(
		'posts_per_page' => -1,
		'post_type'      => 'career',
	)
);
?>
<div class="careers-content next-section">
	<div class="career-title">
		<?php the_title(); ?>
	</div>
	<div class="career-items-list-wrap">
		<?php
		foreach ( $careers as $career ) {
			include( get_template_directory() . '/single-templates/career.php' );
		}
		?>
	</div>

	<?php if ( ! empty( $section_info['apply-now-text'] ) ) : ?>
		<div class="careers-apply-now">
			<?php echo esc_html( $section_info['apply-now-text'] ); ?>
		</div>
	<?php endif; ?>


	<?php if ( ! empty( $section_info['apply-now-url'] ) ) : ?>
		<div class="section-cta">
			<a href="<?php echo esc_url( $section_info['apply-now-url'] ); ?>" class="accern-button">
				<?php echo esc_html__( 'Apply Now' ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
