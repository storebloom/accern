<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Accern_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo esc_url( get_home_url() ); ?>">
				<img src="<?php echo esc_url( asset_path( 'images/accern-logo-white.svg' ) ); ?>" alt="White Logo for Accern" />
			</a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<div class="accern-main-menu-open">
				<img id="open-accern-menu" class="open-menu-icon" src="<?php echo esc_url( asset_path( 'images/icon-menu.svg' ) ); ?>" alt="Open Navigation Menu" />
			</div>
			<div class="accern-main-menu-close">
				<?php echo esc_html__( 'Close', 'accern-custom' ); ?>
				<img id="close-accern-menu" class="menu-icon" src="<?php echo esc_url( asset_path( 'images/icon-close.svg' ) ); ?>" alt="Close Navigation Menu" />
			</div>

			<div class="main-menu-overlay">
				<ul class="accern-primary-menu">
					<?php
					$menu_items = wp_get_nav_menu_items( 'main-menu' );
					$currentPage =  get_the_id();

					foreach ( $menu_items as $num => $menu_item ) :
						$num = intval( $num ) + 1;
						$menuItemId = $menu_item->object_id;
					?>
					<li class="accern-primary-menu-item<?php if($currentPage == $menuItemId) { echo esc_html( ' accern-primary-menu-item-current' ); } ?>">
						<a href="<?php echo esc_url( $menu_item->url ); ?>">
							<div class="accern-menu-item-count"><?php echo esc_html( '0' . $num . '/' ); ?></div>
							<?php echo esc_html( $menu_item->title ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
