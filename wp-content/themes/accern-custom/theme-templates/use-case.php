<?php
/**
 * Template for use case.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Accern_Custom
 */

foreach ( $tabs as $num => $tab_info ) :
	$tab_id = strtolower( str_replace( ' ', '-', $tab_info['title'] ) );
	$active_tab = 1 === $num ? 'active-tab' : '';
?>
	<div id="<?php echo esc_attr( $tab_id ); ?>" class="use-case-content-wrap <?php echo esc_attr( $active_tab ); ?>">
		<div class="use-case-left">
			<?php if ( ! empty( $tab_info['left'][1] ) && is_array( $tab_info['left'] ) ) : ?>
				<?php foreach ( $tab_info['left'] as $num => $usecase_content ) : ?>
					<?php if ( ! empty( $usecase_content['graph-first'] ) ) : ?>
						<div class="usecase-graph-wrap">
							<div class="usecase-graph usecase-graph-first" style="width: <?php echo esc_attr( $usecase_content['graph-first'] ); ?>;"></div>
							<div class="use-case-graph-text">
								<?php echo esc_html( $usecase_content['graph-first-text'] ); ?>
							</div>
							<div class="usecase-graph usecase-graph-second" style="width: <?php echo esc_attr( $usecase_content['graph-second'] ); ?>;"></div>
							<div class="use-case-graph-text">
								<?php echo esc_html( $usecase_content['graph-second-text'] ); ?>
							</div>
							<div class="usecase-graph-content">
								<?php echo wp_kses_post( $usecase_content['graph-content'] ); ?>
							</div>
						</div>
					<?php else : ?>
						<div class="usecase-content">
							<?php echo wp_kses_post( $usecase_content['graph-content'] ); ?>
						</div>
						<?php
					endif;
				endforeach;
			endif;
			?>
		</div>
		<div class="use-case-right">
			<?php if ( ! empty( $tab_info['right'][1] ) && is_array( $tab_info['right'] ) ) : ?>
				<?php foreach ( $tab_info['right'] as $num2 => $usecase_content2 ) : ?>
					<?php if ( ! empty( $usecase_content2['graph-first'] ) ) : ?>
						<div class="usecase-graph-wrap">
							<div class="usecase-graph usecase-graph-first" style="width: <?php echo esc_attr( $usecase_content2['graph-first'] ); ?>;"></div>
							<div class="use-case-graph-text">
								<?php echo esc_html( $usecase_content2['graph-first-text'] ); ?>
							</div>
							<div class="usecase-graph usecase-graph-second" style="width: <?php echo esc_attr( $usecase_content2['graph-second'] ); ?>;"></div>
							<div class="use-case-graph-text">
								<?php echo esc_html( $usecase_content2['graph-second-text'] ); ?>
							</div>
							<div class="usecase-graph-content">
								<?php echo wp_kses_post( $usecase_content2['graph-content'] ); ?>
							</div>
						</div>
					<?php else : ?>
						<div class="usecase-content">
							<?php echo wp_kses_post( $usecase_content2['graph-content'] ); ?>
						</div>
						<?php
					endif;
				endforeach;
			endif;
			?>
		</div>
	</div>
<?php endforeach;
