<?php
  // Step 1 - Adding a custom tab to the Products Metabox
  add_filter( 'woocommerce_product_data_tabs', 'pwyw_settings_tab', 1 , 1 );
  function pwyw_settings_tab( $product_data_tabs ) {
    $product_data_tabs['settings-tab'] = array(
      'label' => __( 'Pay What You Want', 'pwyw' ), // translatable
      'target' => 'settings_tab_data', // translatable
      'class' => array('product_data_tabs', 'show_if_simple', 'show_if_variable'),
    );
    return $product_data_tabs;
  }

  // Step 2 - Adding and POPULATING (with data) custom fields in custom tab for Product Metabox
  add_action( 'woocommerce_product_data_panels', 'pwyw_settings_tab_fields' );
  function pwyw_settings_tab_fields() {

    global $post;

    // echo gettype($post);

    $post_id = $post->ID;
    echo "post id: $post_id";
    ?>

      <?php
        // by default, settings page er ei value saved hoite hbe! 'override defaults' checked hoile, amdr INPUT kora value UPDATE hobe
        $pwyw_fixed_price_name = get_option('pwyw_fixed_price_name');
        // echo gettype($pwyw_fixed_price_name);
        $pwyw_product_tab = wc_get_product( $post_id ); // ??? value kivabe pabo???
        // echo $pwyw_product_tab;
        $is_checked = get_post_meta($post_id, 'pwyw_input_checkbox', true);
        $checked = $is_checked == 1 ? 'checked' : '';

      // Checkbox field
      

      ?>
      <!-- Checkbox field -->
      <div class='show_if_simple show_if_variable'>
        <p>
          <input type='checkbox' name='pwyw_input_checkbox' id='pwyw_input_checkbox' value='1' <?php $checked; ?> />
          <label for='pwyw_input_checkbox'>
            <?php _e('Override Defaults', 'pwyw'); ?>
          </label>
        </p>
      </div>

      <div id='settings_tab_data' class='pwyw_product_data_tab show_if_simple show_if_variable'>

        <!-- <div class='wrapper'>

          <?php //foreach ($pwyw_fixed_price_name as $single_price): ?>
            
            <div class='input_parent'>
              <input type='number' step='any' class='pwyw_fixed_price' name='pwyw_fixed_price_name[]' placeholder='Enter a Price' value="<?php //echo esc_attr($single_price); ?>" min='1' />
              <a href='' class='pwyw_remove'>x</a>
              <! -- javascript:void(0) is equivalent to script e.preventDefault() -- >
            </div>

          <?php //endforeach; ?>

        </div>	<! -- End of wrapper -- >

        <div>
          <p>
            <input type='button' value='+ Add More' id='pwyw_append' />
          </p>
        </div> -->
        
        <div class='wrapper_product'>
        <!-- ei (array) na diya solve krte hbe! -->
          <?php foreach ( (array) $pwyw_product_tab as $product ): ?>
            
            <div class="input_wrapper<?php //if($category_checked) echo '_active'; ?>">
              <input type='number' step='any' class='pwyw_product_tab' name='pwyw_product_tab_name[]' placeholder='Enter a Price' value="<?php echo esc_attr($product); ?>" min='1' />
              <a href='' class='pwyw_remove'>x</a>
              <!-- javascript:void(0) is equivalent to script e.preventDefault() -->
            </div>

          <?php endforeach; ?>

        </div>	<!-- End of wrapper_product -->

        <div class='show_if_simple show_if_variable'>
          <p>
            <input type='button' value='+ Add More' id='pwyw_append_product' />
          </p>
        </div>

        <?php
          
        ?>
      
      </div>	<!-- End of woocommerce_options_panel -->

    <?php
  }



// Step 3 - Saving custom fields data of custom products tab metabox
add_action( 'woocommerce_process_product_meta', 'pwyw_product_meta_fields_save' );
function pwyw_product_meta_fields_save( $post_id ) {
  global $post;
  // echo "post: $post";
  $post_id = $post->ID;    // VEJAAL
  echo "post id is $post_id ";

  /* if( isset( $_POST['pwyw_product_tab_name'] ) ) {
    update_post_meta( $post_id, 'pwyw_product_tab_name', esc_attr( $_POST['pwyw_product_tab_name'] ) );
  } */

  $pwyw_product_price = isset( $_POST['pwyw_product_tab_name'] ) ? $_POST['pwyw_product_tab_name'] : '';
  $pwyw_product_price = sanitize_text_field($pwyw_product_price);

  $is_checked = isset( $_POST['pwyw_input_checkbox'] ) ? $_POST['pwyw_input_checkbox'] : 0;
  
  update_post_meta($post_id, 'pwyw_product_tab_name', $pwyw_product_price);
  update_post_meta($post_id, 'pwyw_input_checkbox', $is_checked);
}