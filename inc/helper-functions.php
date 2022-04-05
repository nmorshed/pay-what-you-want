<?php

function pwyw_predefined_price_set(){

	$default_set = array(5,10,15,20);
	$pwyw_predefined_price_set = get_option( 'pwyw_predefined_price_set', $default_set );

    foreach ( $pwyw_predefined_price_set as $price ) {
    	echo "<div class='price-set-input'><input type='number' pattern='[0-9]+(\\.[0-9][0-9]?)?' name='pwyw_predefined_price_set[]' value='{$price}' /> <span class='pwyw-remove'> x </span></div>";
    }
}

function pwyw_single_product_price_set($post_id){

	$default_set = array(5,10,15,20);
    $price_set = get_post_meta($post_id, 'pwyw-single-price', true);
    if (empty($price_set)) {
    	$price_set = get_option( 'pwyw_predefined_price_set', $default_set );
    }

	//$price_set = array(5,10,15,20);


    $price_display = "";
    $price_display .= "";

    foreach ( $price_set as $price ) {
    	$price_display .= "<div class='price-set-input'><input type='number' pattern='[0-9]+(\\.[0-9][0-9]?)?' name='pwyw-single-price[]' value='{$price}'> <span class='pwyw-remove'> x </span></div>";
    }

    $price_display .= "";
    


    echo $price_display;
}

function pwyw_product_categories_checkbox(){

	$selected_categories = get_option( 'pwyw_product_categories' );
	$product_categories = get_categories( ['taxonomy' => 'product_cat'] );

    $selected = '';
    foreach ( $product_categories as $category ) {

    	$cat_id = $category->term_id;
    	$cat_name = $category->name;

    	if ( !empty( $selected_categories ) ) {
    		$selected = ( in_array( $cat_id, $selected_categories ) ) ? 'checked' : '';
    	}    	

    	echo "<input type='checkbox' name='pwyw_product_categories[]' value='{$cat_id}' id='product-cat-$cat_id' $selected /> <label for='product-cat-$cat_id'>$cat_name </label>";
    }
}