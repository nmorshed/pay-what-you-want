<?php
/***********************************************************************
Custom Metabox in product description
***********************************************************************/

// Display the custom text field
function nj_cfwc_create_custom_field() {
 $args = array(
 'id' => 'nj_connect_p2c',
 'label' => __( 'Add The Course Link(Optional)', 'cfwc' ),
 'class' => 'cfwc-custom-field',
 'desc_tip' => true,
 'description' => __( 'Add the link where the user will be redirected after click in Watch in Your Library.( OPTIONAL )', 'ctwc' ),
 );
 woocommerce_wp_text_input( $args );
}
add_action( 'woocommerce_product_options_general_product_data', 'nj_cfwc_create_custom_field' );


// Save the custom field
function nj_cfwc_save_custom_field( $post_id ) {
 $product = wc_get_product( $post_id );
 $title = isset( $_POST['nj_connect_p2c'] ) ? $_POST['nj_connect_p2c'] : '';
 $product->update_meta_data( 'nj_connect_p2c', sanitize_text_field( $title ) );
 $product->save();
}
add_action( 'woocommerce_process_product_meta', 'nj_cfwc_save_custom_field' );
