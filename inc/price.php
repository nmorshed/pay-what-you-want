<?php


// Get Settings



$pwyw_min_price 			= get_option( 'pwyw_min_price', PWYW_MIN_PRICE );

// Get Fraction of the price
function pwyw_get_fraction_of_the_price($price, $fraction){
	
	$price_set = [];
	$difference = $price / $fraction;

	for ($i = 1; $i <= $fraction ; $i++) {

		$number = (int) ( $i * $difference );
		$price_set[] = $number;
		$price -= ($price - $number);

	}

	return $price_set;
}


// Get the price set
function pwyw_get_the_price_set($product_id, $price){
	
	$price_set = [];
	$pwyw_price_group 		= get_option( 'pwyw_price_group', PWYW_PRICE_GROUP );
	// 0 = predefined price
	// 1 = Depend on product price

	if ( 0 == $pwyw_price_group ) {
		$price_set = get_option( 'pwyw_predefined_price_set', PWYW_PREDEFINED_PRICE );
	}else{
		$pwyw_price_fraction = get_option( 'pwyw_price_fraction', PWYW_PRICE_FRACTION );
		$price_set = pwyw_get_fraction_of_the_price($price, $pwyw_price_fraction);
	}

	return $price_set;
}


/**
 * Add -- before Add to cart
 */
function bw_pwyw_price_select_box_before_add_to_cart() {

	global $product;
	$product_id = $product->id;

	$pwyw_enable_plugin 	= get_option( 'pwyw_enable_plugin', PWYW_ENABLE_PLUGIN );

	if ( 'enabled' != $pwyw_enable_plugin ) {
		return;
	}

	$pwyw_products_area 	= get_option( 'pwyw_products_area', PWYW_PRODUCTS_AREA );
	// 1 = all products
	// 9 = specific categories

	if ( 0 == $pwyw_products_area ) {
		
		$pwyw_product_categories 	= get_option( 'pwyw_product_categories' );
		if( ! has_term( $pwyw_product_categories, 'product_cat', $product_id ) ) {
			return;
		}
	}

	
	$price = $product->get_price();
	$_pwyw_override_defaults = get_post_meta( $product_id, '_pwyw_override_defaults', true );
	
	if ( 'yes' == $_pwyw_override_defaults ) {
		$price_set = get_post_meta( $product_id, 'pwyw-single-price', true );
	}else{
		$price_set = pwyw_get_the_price_set($product_id, $price);
	}

	$pwyw_allow_own_price	= get_option( 'pwyw_allow_own_price', PWYW_ALLOW_OWN_PRICE );

	
	?>
	
	<div class='bw-single-price-area'>
		<input type="hidden" name="bw-price" class="bw-price" value="0">
		<div class="bw-select-price">

			<?php 
			foreach ($price_set as $price) {
				echo "<button data-price='{$price}' class='bw-btn-price'>$ {$price}</button>";
			}
			?>
			<?php if ( 'enabled' == $pwyw_allow_own_price ) { ?>			
			<input type="number" pattern="[0-9]+(\\.[0-9][0-9]?)?" id="bw-own-price" name="" placeholder="My Price">
			<?php } ?>

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