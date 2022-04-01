<?php


// Step 1 - Adding a custom tab to the Products Metabox

function pwyw_settings_tab( $product_data_tabs ) {
  $product_data_tabs['settings-tab'] = array(
    'label' => __( 'Pay What You Want', 'pwyw' ), // translatable
    'target' => 'settings_tab_data', // translatable
    'class' => array('product_data_tabs', 'show_if_simple', 'show_if_variable'),
  );
  return $product_data_tabs;
}

add_filter( 'woocommerce_product_data_tabs', 'pwyw_settings_tab', 1 , 1 );


function woocommerce_product_custom_fields () {
  global $woocommerce, $post;
  $post_id = $post->ID;
  echo "post id is $post_id";

  $pwyw_product_tab = wc_get_product( $post_id );
  // echo gettype($pwyw_product_tab);
  echo '<br />';

  /* echo '<pre>';
  print_r($pwyw_product_tab);
  echo '</pre>'; */

  ?>

  <div class=" product_custom_field ">
    <?php
    // This function has the logic of creating custom field
    //  This function includes input text field, Text area and number field

    // Custom Product Text Field
    /* woocommerce_wp_text_input(
      array(
        'id'          => '_custom_product_text_field',
        'label'       => __( 'My Text Field', 'woocommerce' ),
        'wrapper_class' => 'show_if_simple show_if_variable',
        'placeholder' => 'Custom Product Text Field quick brown fox jumps over the',
        'desc_tip'    => 'true'
      )
    ); */

      ?>
    <!-- <input type='text' id='_custom_product_text_field' placeholder='Custom Product Text Field' /> -->


    <?php

    // foreach ($pwyw_product_tab as $product) {
      // Custom Product Number Field
      woocommerce_wp_text_input(
        array(
          'id' => '_custom_product_number_field',
          'name' => 'pwyw_product_tab_name[]',
          'class' => 'input_wrapper',
          'placeholder' => 'Custom Product Number Field',
          'label' => __('Custom Product Number Field', 'woocommerce'),
          'wrapper_class' => 'show_if_simple show_if_variable',
          'type' => 'number',
          'value' => $pwyw_product_tab,
          'custom_attributes' => array(
            'step' => 'any',
            'min' => '0'
          )
        )
      );
    // }
    ?>

    <div style='text-align: right;' class='show_if_simple show_if_variable'>
      <p>
        <input type='button' value='+ Add More' id='pwyw_append_product' />
      </p>
    </div>

    <?php
    

    // Custom Product Textarea Field
    /* woocommerce_wp_textarea_input(
      array(
          'id' => '_custom_product_textarea',
          'placeholder' => 'Custom Product Textarea',
          'label' => __('Custom Product Textarea', 'woocommerce')
      )
    ); */
    ?>
  </div>
  <?php
}


// The code for displaying WooCommerce Product Custom Fields
add_action( 'woocommerce_product_data_panels', 'woocommerce_product_custom_fields' ); 

// Saving Data in the Database
function woocommerce_product_custom_fields_save($post_id) {
  // Custom Product Text Field
  $woocommerce_custom_product_text_field = $_POST['_custom_product_text_field'];
  if (!empty($woocommerce_custom_product_text_field))
      update_post_meta($post_id, '_custom_product_text_field', esc_attr($woocommerce_custom_product_text_field));
  // Custom Product Number Field
  $woocommerce_custom_product_number_field = $_POST['pwyw_product_tab_name'];
  if (!empty($woocommerce_custom_product_number_field))
      update_post_meta($post_id, 'pwyw_product_tab_name', esc_attr($woocommerce_custom_product_number_field));
  // Custom Product Textarea Field
  $woocommerce_custom_procut_textarea = $_POST['_custom_product_textarea'];
  if (!empty($woocommerce_custom_procut_textarea))
      update_post_meta($post_id, '_custom_product_textarea', esc_html($woocommerce_custom_procut_textarea));
}

// Following code Saves  WooCommerce Product Custom Fields
add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save' );