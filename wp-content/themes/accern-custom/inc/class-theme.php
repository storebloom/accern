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
	 * Register MU Script
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_assets() {
		wp_register_script( "{$this->assets_prefix}-front-ui", "{$this->dir_url}/js/accern-front-ui.js", array(
			'jquery',
			'wp-util',
		), time() );
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
		), time() );
	}
}
