<?php
/**
 * Template for company partner.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$partner_thumbnail = get_the_post_thumbnail_url( $partner->ID );

// Get linkedin account link.
$partner_link = get_post_meta( $partner->ID, 'page-meta', true );
$partner_link = isset( $partner_link['partner-section-accern']['link'] ) ? $partner_link['partner-section-accern']['link'] : '';
?>
<div class="parnter-item">
	<div class="partner-photo">
		<?php if ( ! empty( $partner_link ) ) : ?>
			<a href="<?php echo esc_url( $partner_link ); ?>">
		<?php endif; ?>

		<div class="partner-logo-name">
			<?php if ( ! empty( $partner_thumbnail ) ) : ?>
				<img src="<?php echo esc_url( $partner_thumbnail ); ?>">
			<?php else : ?>
				<?php echo esc_html( $partner->post_title ); ?>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $partner_link ) ) : ?>
			</a>
		<?php endif; ?>
	</div>
</div>
