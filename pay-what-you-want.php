<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Pay What You Want
 * Plugin URI:        http://betterwizard.com
 * Description:       A simple tool to add a variable payment option to your product so that people can buy your product with a given of sets of price.
 * Version:           2.0
 * Author:            Better Wizard
 * Author URI:        http://betterwizard.com
 * Text Domain:       bw-pwyw
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' )) {
  exit();
}

/***********************************
	Check Dependency
***********************************/


add_action( 'admin_notices', function() {

	$notice = '<div class="notice notice-error is-dismissible">';
		$notice .= "<p>Please install <strong> WooCommerce </strong> plugin before use the <strong>Pay What You Want</strong> plugin</p>";
	$notice .= '</div>';

	if ( ! class_exists( 'WooCommerce' ) ) {
		echo $notice;
	}

});


/***********************************
	Load JS & CSS Files
***********************************/
function bw_pwyw_style_and_scripts() {

	wp_enqueue_style( 'pay_what_you_want_style', plugins_url( '/css/styles.css', __FILE__ ) );
	wp_enqueue_script( 'pay_what_you_want_script', plugins_url( '/js/scripts.js', __FILE__ ) , array('jquery'), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'bw_pwyw_style_and_scripts');


/***********************************
	Load JS & CSS for admin screen
***********************************/
function bw_pwyw_admin_style_and_scripts() {

	wp_enqueue_script( 'pay_what_you_want_admin_script', plugins_url( '/js/admin-scripts.js', __FILE__ ) , array('jquery'), '1.0.0', true);
	wp_enqueue_style( 'pay_what_you_want_admin_style', plugins_url( '/css/admin-styles.css', __FILE__ ), '', '1.0' );

}
add_action('admin_enqueue_scripts', 'bw_pwyw_admin_style_and_scripts');


/***********************************
	Required Files
***********************************/

add_action( 'plugins_loaded', function(){

	if ( class_exists( 'WooCommerce' ) ) {
		require_once( plugin_dir_path( __FILE__ ) . 'inc/price.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'inc/settings-page.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'inc/helper-functions.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'inc/single-product-settings.php' );
	}
});