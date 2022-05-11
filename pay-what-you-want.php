<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Pay What You Want
 * Plugin URI:        https://betterwizard.com/product/pay-what-you-want/
 * Description:       A simple tool to add a variable payment option to your product so that people can buy your product with a given of sets of price.
 * Version:           1.0.0
 * Author:            Better Wizard
 * Author URI:        https://betterwizard.com/
 * Text Domain:       pwyw
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' )) {
	exit();
}

/***********************************
	Check Dependency
***********************************/
add_action( 'admin_notices', function() {

	if ( ! class_exists( 'WooCommerce' ) ) { ?>
		<div class="notice notice-error is-dismissible">
			<p>Please install <strong> WooCommerce </strong> plugin before use the <strong>Pay What You Want</strong> plugin</p>
		</div> <?php
	}

});

/***********************************
	Default Values
***********************************/
define( 'PWYW_ENABLE_PLUGIN', 'enabled' );
define( 'PWYW_ALLOW_OWN_PRICE', 'disabled' );
define( 'PWYW_ADD_TO_CART_BTN_INSIDE_LOOP', 'disabled' );
define( 'PWYW_HIDE_SINGLE_PRICE', 'disabled' );
define( 'PWYW_PRODUCTS_AREA',  1);
define( 'PWYW_PRICE_GROUP',  0);
define( 'PWYW_PRICE_FRACTION', 4 );
define( 'PWYW_MIN_PRICE', 5 );
define( 'PWYW_PRICE_TEXT', 'Original Price : %price%' );
define( 'PWYW_PREDEFINED_PRICE', [5,10,15,20] );
define( 'PWYW_PLUGIN_BASENAME', plugin_basename(__FILE__) );

/***********************************
	Load JS & CSS Files
***********************************/
if ( ! function_exists( 'bw_pwyw_style_and_scripts' ) ) {
	function bw_pwyw_style_and_scripts() {

		wp_enqueue_style( 'pay_what_you_want_style', plugins_url( '/css/styles.css', __FILE__ ) );
		wp_enqueue_script( 'pay_what_you_want_script', plugins_url( '/js/scripts.js', __FILE__ ) , array('jquery'), '1.0.0', true);

	}
	add_action( 'wp_enqueue_scripts', 'bw_pwyw_style_and_scripts' );
}

/***********************************
	Load JS & CSS for admin screen
***********************************/
if ( ! function_exists( 'bw_pwyw_admin_style_and_scripts' ) ) {
	function bw_pwyw_admin_style_and_scripts() {

		wp_enqueue_script( 'pay_what_you_want_admin_script', plugins_url( '/js/admin-scripts.js', __FILE__ ) , array('jquery'), '1.0.0', true );
		wp_enqueue_style( 'pay_what_you_want_admin_style', plugins_url( '/css/admin-styles.css', __FILE__ ), '', '1.0' );

	}
	add_action( 'admin_enqueue_scripts', 'bw_pwyw_admin_style_and_scripts' );
}

/***********************************
	Required Files
***********************************/

add_action( 'plugins_loaded', function() {

	if ( class_exists( 'WooCommerce' ) ) {
		require_once( plugin_dir_path( __FILE__ ) . 'inc/helper-functions.php' );		
		if ( is_admin() ) {
			require_once( plugin_dir_path( __FILE__ ) . 'inc/settings-page.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'inc/single-product-settings.php' );
		}else{
			require_once( plugin_dir_path( __FILE__ ) . 'inc/pay-what-you-want.php' );
		}		
	}

} );