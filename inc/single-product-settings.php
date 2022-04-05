<?php

// Register the Tab
add_filter( 'woocommerce_product_data_tabs', 'pwyw_product_data_tab' );
function pwyw_product_data_tab( $tabs ) {
    $tabs['pwyw-tab'] = array(
        'label' => __( 'Pay What You Want', 'pwyw' ),
        'target' => 'pwyw-tab',
        'class'     => array( 'show_if_simple','show_if_variable' ),
    );
    return $tabs;
}





// Settings Fields.
add_action('woocommerce_product_data_panels', 'pwyw_single_product_settings_fields');

function pwyw_single_product_settings_fields() {
    
    global $post;

    $post_id = $post->ID;
    $val = get_post_meta($post_id, 'pwyw-single-price', true);
print_r($val);

    ?>
    

    <div id='pwyw-tab' class = 'panel woocommerce_options_panel'>
    	<div class = 'options_group' > <?php

			// Override Defaults
			woocommerce_wp_checkbox(
			    array(
					'id' => '_checkbox',
					'label' => __('Override Defaults?', 'pwyw' ),
					'description' => __( 'Override', 'pwyw' )
			    )
			); ?>

            <div class="pwyw-price-box">
                <div id='pwyw_predefined_price_set'>
                    <label>Set Price For This product</label>

                    <?php pwyw_single_product_price_set($post_id); ?>
                </div>
                <div id="pwyw-add-price">
                    Add More Price +
                </div>
            </div>

		</div>
    </div><?php
}




/** Hook callback function to save custom fields information */
function woocom_save_proddata_custom_fields($post_id) {
    // Save Text Field
    $text_field = $_POST['pwyw-single-price'];
    if (!empty($text_field)) {
        update_post_meta($post_id, 'pwyw-single-price', ($text_field));
    }

    // Save Checkbox
    $checkbox = isset($_POST['_checkbox']) ? 'yes' : 'no';
    update_post_meta($post_id, '_checkbox', $checkbox);
}

add_action( 'woocommerce_process_product_meta_simple', 'woocom_save_proddata_custom_fields'  );

// You can uncomment the following line if you wish to use those fields for "Variable Product Type"
add_action( 'woocommerce_process_product_meta_variable', 'woocom_save_proddata_custom_fields'  );