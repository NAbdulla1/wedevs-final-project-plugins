<?php

/*
Plugin Name: Show Product Attributes After product summary description
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This plugin shows the current product attributes after summary description and remove Additional Information tab and Description tab on Single Product Page
Version: 1.0
Author: nayon
Author URI: http://URI_Of_The_Plugin_Author
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The starter class
 * Class Product_Attributes_After_Description
 */
final class Product_Attributes_After_Description {
	const VERSION = '1.0';

	/**
	 * Product_Attributes_Before_Cart constructor.
	 */
	private function __construct() {
		$this->define_constants();
		register_activation_hook( __FILE__, [ $this, 'activate' ] );

		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

	/**
	 * Ensures Singleton instance
	 * @return false|Product_Attributes_After_Description
	 */
	public static function init() {
		static $instance = false;
		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Defines constants for later user
	 */
	private function define_constants() {
		define( "NWP_PAAD_VERSION", self::VERSION );
		define( "NWP_PAAD_FILE", __FILE__ );
		define( "NWP_PAAD_PATH", __DIR__ );
		define( "NWP_PAAD_URL", plugins_url( '', NWP_PAAD_FILE ) );
		define( "NWP_PAAD_ASSETS", NWP_PAAD_URL . '/assets' );
	}

	/**
	 * Plugin activator callback
	 */
	public function activate() {

		$installed = get_option( 'nwp_paad_installed', false );
		if ( ! $installed ) {
			update_option( 'nwp_paad_installed', time() );
		}
		update_option( 'nwp_paad_version', NWP_PAAD_VERSION );
	}

	/**
	 * Plugin Initiator function
	 */
	public function init_plugin() {
		if ( ! is_admin() ) {
			new \NWP_PAAD\Frontend();
		}
	}
}

/**
 * Helper
 */
function nwp_paad() {
	Product_Attributes_After_Description::init();
}

/**
 * Entry Point
 */
nwp_paad();

