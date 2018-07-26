<?php
/**
 * Template for company page team member.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$member_thumbnail = get_the_post_thumbnail_url( $member->ID );
$count = $i;
$count = 10 > $count ? '0' . $count . '/' : $count . '/';

// Get linkedin account link.
$member_linkedin = get_post_meta( $member->ID, 'page-meta', true );
$member_linkedin = isset( $member_linkedin['team-section-accern']['linkedin'] ) ? $member_linkedin['team-section-accern']['linkedin'] : '';
?>
<div class="team-member-item">
	<div class="team-member-photo">
		<?php if ( ! empty( $member_linkedin ) ) : ?>
			<a href="<?php echo esc_url( $member_linkedin ); ?>">
		<?php endif; ?>

		<img src="<?php echo esc_url( $member_thumbnail ); ?>">

		<?php if ( ! empty( $member_linkedin ) ) : ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="team-member-info">
		<div class="member-count"><?php echo esc_html( $count ); ?></div>
		<div class="member-name"><?php echo esc_html( $member->post_title ); ?></div>
		<div class="member-title"><?php echo wp_kses_post( $member->post_content ); ?></div>
	</div>
</div>
