<?php
/**
 * Bootstraps the Accern Custom theme.
 *
 * @package Accern_Custom
 */

namespace AccernCustom;

/**
 * Main plugin bootstrap file.
 */
class Theme extends Theme_Base {

	/**
	 * Plugin assets prefix.
	 *
	 * @var string Lowercased dashed prefix.
	 */
	public $assets_prefix;

	/**
	 * Plugin meta prefix.
	 *
	 * @var string Lowercased underscored prefix.
	 */
	public $meta_prefix;

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		parent::__construct();

		// Initiate classes.
		$classes = array(
			new Custom_Fields( $this ),
			new Register( $this ),
		);

		// Add classes doc hooks.
		foreach ( $classes as $instance ) {
			$this->add_doc_hooks( $instance );
		}

		// Define some prefixes to use througout the plugin.
		$this->assets_prefix = strtolower( preg_replace( '/\B([A-Z])/', '-$1', __NAMESPACE__ ) );
		$this->meta_prefix = strtolower( preg_replace( '/\B([A-Z])/', '_$1', __NAMESPACE__ ) );
	}

	/**
	 * Register Front Assets
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_assets() {
		// Version CSS file in a theme
		wp_enqueue_style( 'theme-styles', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
		wp_enqueue_style( 'accern-custom-style', asset_path( 'styles/main.css' ), array() );
		wp_register_script( "{$this->assets_prefix}-animation-manifest", "{$this->dir_url}/js/animation/manifest.2ae2e69a05c33dfc65f8.js", array(), false );
		wp_register_script( "{$this->assets_prefix}-animation-vendor", "{$this->dir_url}/js/animation/vendor.6a274349fb8ac9adac60.js", array(), false );
		wp_register_script( "{$this->assets_prefix}-animation-app", "{$this->dir_url}/js/animation/app.f20f7f688b95f685e972.js", array(), false );
		wp_register_script( "{$this->assets_prefix}-front-ui", "{$this->dir_url}/js/accern-front-ui.js", array(
			'jquery',
			'wp-util',
			"{$this->assets_prefix}-scrollify",
			"{$this->assets_prefix}-animation-app",
			"{$this->assets_prefix}-animation-manifest",
			"{$this->assets_prefix}-animation-vendor",
		), time(), true );
		wp_register_script( "{$this->assets_prefix}-scrollify", 'https://cdnjs.cloudflare.com/ajax/libs/scrollify/1.0.19/jquery.scrollify.min.js', array(
			'jquery',
		) );
	}

	/**
	 * Register admin scripts/styles.
	 *
	 * @action admin_enqueue_scripts
	 */
	public function register_admin_assets() {
		wp_register_script( "{$this->assets_prefix}-custom-fields", "{$this->dir_url}/js/accern-custom-fields.js", array(
			'jquery',
			'wp-util',
		) );
	}
}
