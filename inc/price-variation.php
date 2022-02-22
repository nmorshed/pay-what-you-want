<?php

class bw_price_variation {
	
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'bw_create_page' ) );
		// add_action( 'admin_post_bw_hidden_input', array( $this, 'bw_save_form' ) );
	}

	public function bw_create_page() {
    // set 'product' menu as parent slug
    $parent_slug = __('edit.php?post_type=product', 'bw');
		$page_title = __( 'Price Variation', 'bw' );
		$menu_title = __( 'Price Variation', 'bw' );
		$capability = 'manage_options';
		$menu_slug = 'bw';
		$callback   = array( $this, 'bw_page_content' );
    // $position = null;

    add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback );
	}

	public function bw_page_content() {
		?>
    <h1><?php _e('Price Variation', 'bw'); ?></h1>

    <?php
	}

	/* public function bw_save_form() {

		if ( isset($_POST['bw_password']) ) {
			
			update_option( 'bw_password', sanitize_text_field($_POST['bw_password']) );

			wp_redirect('admin.php?page=bw');
		}
	} */

}

new bw_price_variation();