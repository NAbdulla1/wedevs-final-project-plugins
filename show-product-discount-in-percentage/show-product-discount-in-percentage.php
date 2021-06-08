<?php

/*
Plugin Name: Show Product Discount in Percentage
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This plugin shows the product discount in percentage with price.
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
 * Class Product_Attributes_Before_Cart
 */
final class Product_Discount_In_Percentage {
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
	 * @return false|Product_Discount_In_Percentage
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
		define( "NWP_PDIP_VERSION", self::VERSION );
		define( "NWP_PDIP_FILE", __FILE__ );
		define( "NWP_PDIP_PATH", __DIR__ );
		define( "NWP_PDIP_URL", plugins_url( '', NWP_PDIP_FILE ) );
		define( "NWP_PDIP_ASSETS", NWP_PDIP_URL . '/assets' );
	}

	/**
	 * Plugin activator callback
	 */
	public function activate() {

		$installed = get_option( 'nwp_pdip_installed', false );
		if ( ! $installed ) {
			update_option( 'nwp_pdip_installed', time() );
		}
		update_option( 'nwp_pdip_version', NWP_PDIP_VERSION );
	}

	/**
	 * Plugin Initiator function
	 */
	public function init_plugin() {
		if ( ! is_admin() ) {
			new \NWP_PDIP\Frontend();
		}
	}
}

/**
 * Helper
 */
function nwp_pdip() {
	Product_Discount_In_Percentage::init();
}

/**
 * Entry Point
 */
nwp_pdip();

