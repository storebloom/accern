<?php
/**
 * Template part for company page team section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_section_info( 'company', 'team', get_the_ID() );
$team_regions = get_terms(
	array(
	'taxonomy'   => 'team_region',
	'order'      => 'ASC',
	'hide_empty' => true,
	)
);
?>
<div data-section="2" id="company-team-section" class="company-section">
	<?php if ( isset( $section_info['title'] ) && '' !== $section_info['title'] ) : ?>
		<?php if ( wp_is_mobile() ) : ?>
			<a name="team"></a>
		<?php endif; ?>

		<div class="section-title">
			<?php echo esc_html( $section_info['title'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['sub-title'] ) && '' !== $section_info['sub-title'] ) : ?>
		<div class="section-sub-title">
			<?php echo esc_html( $section_info['sub-title'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $section_info['content'] ) && '' !== $section_info['content'] ) : ?>
		<div class="section-content">
			<?php echo wp_kses_post( $section_info['content'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $section_info['overlay-repeater'][1]['title'] ) && is_array( $section_info['overlay-repeater'] ) ) : ?>
		<?php foreach ( $section_info['overlay-repeater'] as $num => $overlay_links ) : ?>
			<?php if ( ! empty( $overlay_links['url'] ) ) : ?>
				<div class="section-cta">
					<a href="<?php echo esc_url( $overlay_links['url'] ); ?>" class="accern-button">
						<?php echo esc_html( $overlay_links['title'] ); ?>
					</a>
				</div>
			<?php else : ?>
				<div class="section-overlay">
					<a class="accern-overlay-button" data-section="company-team-section" data-num="<?php echo esc_attr( $num ); ?>" id="company-team-overlay-<?php echo esc_attr( $num ); ?>">
						<?php echo esc_html( $overlay_links['title'] ); ?>
					</a>
				</div>
				<?php
			endif;
		endforeach;
	endif;
	?>

	<?php $i = 0; foreach ( $team_regions as $region ) :
			$args = array(
				'posts_per_page' => -1,
				'post_type'     => 'team',
				'tax_query'     => array(
					array(
						'taxonomy' => 'team_region',
						'field' => 'name',
						'terms' => array( $region->name ),
					),
				),
			);
		?>
		<div class="team-region-list">
			<div class="section-title">
				<?php echo esc_html( $region->name ); ?>, <?php echo esc_html( $region->description ); ?>
			</div>
			<?php
			$team_members = get_posts( $args );

			foreach ( $team_members as $count => $member ) {
				$i ++;
				include( get_template_directory() . '/theme-templates/company-member.php' );
			}
			?>
		</div>
	<?php endforeach; ?>
</div>
