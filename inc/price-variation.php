<?php

class pwyw_price_variation {
	
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'pwyw_create_page' ) );
		add_action( 'admin_post_pwyw_hidden_input', array( $this, 'pwyw_save_form' ) );
	}

	public function pwyw_create_page() {
    // set 'product' menu as parent slug
    $parent_slug = __('edit.php?post_type=product', 'pwyw');
		$page_title = __( 'Price Variation', 'pwyw' );
		$menu_title = __( 'Price Variation', 'pwyw' );
		$capability = 'manage_options';
		$menu_slug = 'pwyw';
		$callback   = array( $this, 'pwyw_page_content' );
    // $position = null;

    add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback );
	}

	public function pwyw_page_content() {
    require_once plugin_dir_path(__FILE__)."/form.php";
	}

	public function pwyw_save_form() {

		if ( isset($_POST['pwyw_products']) || isset($_POST['pwyw_price']) || isset($_POST['pwyw_various_price_name']) || isset($_POST['pwyw_fixed_price_name']) || isset($_POST['pwyw_each_category']) ) {
			
			update_option( 'pwyw_products', sanitize_text_field($_POST['pwyw_products']) );
			update_option( 'pwyw_price', sanitize_text_field($_POST['pwyw_price']) );
			update_option( 'pwyw_various_price_name', sanitize_text_field($_POST['pwyw_various_price_name']) );
			update_option( 'pwyw_fixed_price_name', $_POST['pwyw_fixed_price_name'] );
			update_option( 'pwyw_each_category', $_POST['pwyw_each_category'] );

			wp_redirect('admin.php?page=pwyw');

		}
	}

}

new pwyw_price_variation();