<?php
/**
 * Add -- before Add to cart
 */
function bw_pwyw_price_select_box_before_add_to_cart() {

	global $product;

	?>
	
	<div class='bw-single-price-area'>
		<input type="hidden" name="bw-price" class="bw-price" value="0">
		<div class="bw-select-price">
			<button data-price='5' class="bw-btn-price">$5</button>
			<button data-price='10' class="bw-btn-price">$10</button>
			<button data-price='15' class="bw-btn-price">$15</button>
			<button data-price='25' class="bw-btn-price">$25</button>
		</div>
	</div>

	<?php
}

add_action( 'woocommerce_before_add_to_cart_button', 'bw_pwyw_price_select_box_before_add_to_cart', 10 );





/**
 * Add -- to cart
 */
function bw_pwyw_add_price_to_cart( $cart_item_data, $product_id, $variation_id ) {
	
	$bw_price = filter_input( INPUT_POST, 'bw-price' );

	if ( empty( $bw_price ) ) {
		return $cart_item_data;
	}

	/*echo "<pre>";
	print_r($cart_item_data);
	echo "</pre>";*/

	$cart_item_data['bw-price'] = $bw_price;

	return $cart_item_data;
}

add_filter( 'woocommerce_add_cart_item_data', 'bw_pwyw_add_price_to_cart', 10, 3 );


/**
 * Update -- Price
 */

/*add_action('woocommerce_cart_calculate_fees', 'spa_set_own_package_price', 10, 1 );
function spa_set_own_package_price( $wc_cart ){

	foreach ( $wc_cart->get_cart() as $cart_item_key => $cart_item ) {

		$bw_price = $cart_item['bw-price'];

		if ( ! empty( $bw_price) ) {
			
			$cart_item['data']->set_price( $bw_price );
			
		}
		
	}

}*/


function elex_wfp_before_calculate_totals( $cart_obj ) {

    foreach( $cart_obj->get_cart() as $key=>$value ) {
        if ( isset( $value['bw-price'] )) {
            $price = $value['bw-price'];
            $value['data']->set_price( $price );
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'elex_wfp_before_calculate_totals', 10, 3 );