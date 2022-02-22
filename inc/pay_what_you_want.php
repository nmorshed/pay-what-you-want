<?php
/**
 * Add -- before Add to cart
 */

function bw_pwyw_price_select_box_before_add_to_cart() {

	global $product;
	/* echo '<pre>';
	print_r($product->regular_price);	// product er ID theke price access krbo
	echo '</pre>'; */

	// $product is an object; so, we get $regular_price as following
	$base_price = $product->regular_price;

	$price_1 = round($base_price / 4);
	$price_2 = round($base_price / 4 * 2);
	$price_3 = round($base_price / 4 * 3);
	$price_4 = round($base_price / 4 * 4);

	?>

	<!-- function nite hbe, shop page theke kaj krbo -->
	
	<div class='bw-single-price-area'>
		<input type="hidden" name="bw-price" class="bw-price" value="0">
		<div class="bw-select-price">
			<!-- key note, ekta html attribute html nei r php, hoy FULL html a nite hbe, naile FULL php te; e.g. data-price=<\?php{$price_1}"; ?> NOT ALLOWED -->
			<button <?php echo "data-price={$price_1}"; ?> class="bw-btn-price">৳<?php echo $price_1; ?></button>
			<button <?php echo "data-price={$price_2}"; ?> class="bw-btn-price">৳<?php echo $price_2; ?></button>
			<button <?php echo "data-price={$price_3}"; ?> class="bw-btn-price">৳<?php echo $price_3; ?></button>
			<button <?php echo "data-price={$price_4}"; ?> class="bw-btn-price">৳<?php echo $price_4; ?></button>
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