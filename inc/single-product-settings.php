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
    $post_id = $post->ID; ?>

    <div id='pwyw-tab' class = 'panel woocommerce_options_panel'>
    	<div class = 'options_group' > <?php

			// Override Defaults
			woocommerce_wp_checkbox(
			    array(
					'id' => '_pwyw_override_defaults',
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

// Save data
function woocom_save_proddata_custom_fields($post_id) {

    $pwyw_single_rice = $_POST['pwyw-single-price'];
    if (!empty($pwyw_single_rice)) {
        update_post_meta($post_id, 'pwyw-single-price', ($pwyw_single_rice));
    }

    $checkbox = isset($_POST['_pwyw_override_defaults']) ? 'yes' : 'no';
    update_post_meta($post_id, '_pwyw_override_defaults', $checkbox);
}

add_action( 'woocommerce_process_product_meta_simple', 'woocom_save_proddata_custom_fields'  );
add_action( 'woocommerce_process_product_meta_variable', 'woocom_save_proddata_custom_fields'  );