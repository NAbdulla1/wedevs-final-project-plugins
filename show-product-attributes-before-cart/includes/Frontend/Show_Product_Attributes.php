<?php


namespace NWP_PAAD\Frontend;

/**
 * Class Show_Product_Attributes
 * @package NWP_PAAD\Frontend
 */
class Show_Product_Attributes {
	/**
	 * Show_Product_Attributes constructor.
	 */
	public function __construct() {
		add_action( 'woocommerce_simple_add_to_cart', [ $this, 'show_attrs' ] );
		add_filter( 'woocommerce_product_tabs', [ $this, 'remove_product_tabs' ] );
	}

	/**
	 * Show the attributes
	 */
	public function show_attrs() {
		if ( is_product() ) {
			global $product;
			echo '<h3>Specifications</h3>';
			wc_display_product_attributes( $product );
		}
	}

	/**
	 * Remove the unnecessary tabs
	 *
	 * @param $tabs
	 *
	 * @return mixed
	 */
	public function remove_product_tabs( $tabs ) {
		if ( is_product() ) {
			unset( $tabs['description'] );
			unset( $tabs['additional_information'] );
		}

		return $tabs;
	}
}
