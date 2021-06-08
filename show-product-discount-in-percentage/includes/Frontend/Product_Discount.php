<?php


namespace NWP_PDIP\Frontend;

/**
 * Class Product_Discount
 * @package NWP_PDIP\Frontend
 */
class Product_Discount {
	/**
	 * Product_Discount constructor.
	 */
	public function __construct() {
		add_filter( 'woocommerce_get_price_html', array( $this, 'add_percentage' ) );
	}

	/**
	 * Percentage filter callback
	 *
	 * @param $price
	 *
	 * @return string
	 */
	public function add_percentage( $price ) {
		global $product;
		$regular_price = $product->get_regular_price();
		$sale_price    = $product->get_sale_price();
		$discount      = $regular_price - $sale_price;
		$discount_perc = sprintf( "%.2lf%% off", 100 * $discount / $regular_price );

		return $price . "<br/><strong>$discount_perc</strong>";
	}
}