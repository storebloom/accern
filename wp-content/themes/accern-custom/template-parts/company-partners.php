<?php
/**
 * Template part for company page partners section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$section_info = get_section_info( 'company', 'partners', get_the_ID() );
$associations = get_terms(
	array(
	'taxonomy'   => 'association',
	'order'      => 'ASC',
	'hide_empty' => true,
	)
);
?>
<div data-section="3" id="company-partners-section" class="company-section">
	<?php if ( isset( $section_info['title'] ) && '' !== $section_info['title'] ) : ?>
		<?php if ( wp_is_mobile() ) : ?>
			<a name="partners"></a>
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
					<a class="accern-overlay-button" data-section="company-partners-section" data-num="<?php echo esc_attr( $num ); ?>" id="company-partners-overlay-<?php echo esc_attr( $num ); ?>">
						<?php echo esc_html( $overlay_links['title'] ); ?>
					</a>
				</div>
				<?php
			endif;
		endforeach;
	endif;
	?>

	<?php $i = 0; foreach ( $associations as $type ) :
		$args = array(
			'posts_per_page' => -1,
			'post_type'     => 'partner',
			'tax_query'     => array(
				array(
					'taxonomy' => 'association',
					'field' => 'name',
					'terms' => array( $type->name ),
				),
			),
		);
		?>
		<div class="associations-list">
			<div class="section-title">
				<?php
				echo esc_html__( 'Our ', 'accern-custom' );
				echo esc_html( $type->name );
				?>
			</div>
			<div class="association-cta">
				<a class="accern-button" href="<?php echo esc_url( $type->description ); ?>">
					<?php echo 'Investors' === $type->name ?  esc_html__( 'Become An ', 'accern-custom' ) : esc_html__( 'Become A ', 'accern-custom' ); ?>
					<?php echo esc_html( substr( $type->name, 0, -1 ) ); ?>
				</a>
			</div>
			<?php
			$partners = get_posts( $args );

			foreach ( $partners as $partner ) {
				$i ++;
				include( get_template_directory() . '/theme-templates/company-partner.php' );
			}
			?>
		</div>
	<?php endforeach; ?>
</div>
