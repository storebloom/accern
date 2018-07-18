<?php
/**
 * Template part for use cases page cases section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

$args = array(
	'post_per_page' => -1,
	'post_type'     => 'usecase',
	'order'          => 'ASC',
);

$use_cases = get_posts( $args );
?>
<div id="usecase-cases-section">
	<div class="usecase-list">
		<?php
		foreach ( $use_cases as $case ) :
			$case_info = get_post_meta( $case->ID, 'page-meta', true );
			$case_info = ! empty( $case_info ) ? $case_info : array();
			$tabs = isset( $case_info['usecase-tab-section']['usecase-repeater'] ) ? $case_info['usecase-tab-section']['usecase-repeater'] : '';

			if ( array() !== $case_info ) : ?>
				<div class="section-title">
					<?php echo esc_html( $case->post_title ); ?>
				</div>
				<div class="section-sub-title">
					<?php echo esc_html( $case_info['usecase-main-section']['sub-title'] ); ?>
				</div>
			<?php
				include( get_template_directory() . '/theme-templates/use-case.php' );

			foreach ( $tabs as $num => $tab_info ) :
					$tab_id = strtolower( str_replace( ' ', '-', $tab_info['title'] ) );
				?>
					<li data-tab="<?php echo esc_attr( $tab_id ); ?>" class="tab-item">
						<?php echo esc_html( $tab_info['title'] ); ?>
					</li>
		<?php
				endforeach;
			endif;
		endforeach;
		?>
	</div>
</div>
