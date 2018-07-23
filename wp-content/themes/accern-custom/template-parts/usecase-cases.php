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

foreach ( $use_cases as $num => $case ) :
	$section_num = intval( $num ) + 2;
	$case_info = get_post_meta( $case->ID, 'page-meta', true );
	$sectionid = count( $use_cases ) === intval( $num ) + 1 ? 'id=usecase-last-section' : '';
	$case_name[] = $case->post_title;
	$case_info = ! empty( $case_info ) ? $case_info : array();
	$tabs = isset( $case_info['usecase-tab-section']['usecase-repeater'] ) ? $case_info['usecase-tab-section']['usecase-repeater'] : '';
	?>
	<div data-section="<?php echo esc_attr( $section_num ); ?> "<?php echo esc_attr( $sectionid ); ?> class="usecase-section">
		<a name="<?php echo esc_attr( $case->post_title ); ?>"></a>

		<?php if ( array() !== $case_info ) : ?>
			<div class="section-title">
				<?php echo esc_html( $case->post_title ); ?>
			</div>
			<div class="section-sub-title">
				<?php echo esc_html( $case_info['usecase-main-section']['sub-title'] ); ?>
			</div>
			<div class="usecase-tab-content">
				<?php include( get_template_directory() . '/theme-templates/use-case.php' ); ?>
			</div>
			<div class="usecase-tabs">
				<?php
				foreach ( $tabs as $num2 => $tab_info ) :
						$current_tab = 1 === $num2 ? 'current-tab' : '';
						$single_tab = count( $tabs ) === 1 ? 'single-tab' : '';

						// Tab Id for usecase.
						$tab_id = strtolower( preg_replace( '/[^\w]/', '', $tab_info['title'] ) ) . '-' . strtolower( preg_replace( '/[^\w]/', '', $case->post_title ) );
					?>
						<li data-tab="<?php echo esc_attr( $tab_id ); ?>" class="tab-item <?php echo esc_attr( $current_tab ); ?> <?php echo esc_attr( $single_tab ); ?>">
							<?php echo esc_html( $tab_info['title'] ); ?>
						</li>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endforeach; ?>

<?php
array_unshift( $case_name, $section_info['title'] );

// Nav icons.
get_accern_nav_icons( $id, count( $use_cases ) + 1, 'usecase', $case_name, true );
