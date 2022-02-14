<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Pay What You Want
 * Plugin URI:        http://betterwizard.com
 * Description:       A simple tool to add a variable payment option to your product so that people can buy your product with a given of sets of price.
 * Version:           2.0
 * Author:            Better Wizard
 * Author URI:        http://betterwizard.com
 * Text Domain:       bw
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' )){
    exit();
}

/***********************************
	Check Dependency
***********************************/


add_action( 'admin_notices', function() {

	$notice = '<div class="notice notice-error is-dismissible">';
    	$notice .= "<p>Please install <strong> WooCommerce </strong> plugin before use the Pay What You Want plugin</p>";
	$notice .= '</div>';

	if ( ! class_exists( 'WooCommerce' ) ) {
		echo $notice;
	}

});


/***********************************
	Load Js & Css Files
***********************************/
function bw_pay_what_you_want_style_and_scripts(){

	wp_enqueue_style( 'pay_what_you_want_style', plugins_url( '/css/styles.css', __FILE__ ) );	
	wp_enqueue_script( 'pay_what_you_want_script', plugins_url( '/js/scripts.js', __FILE__ ) , array('jquery'), '1.0.0', true);

	$data = array(
		"admin_ajax"	=> admin_url("admin-ajax.php"),
		"_nonce"		=> wp_create_nonce( 'pay_what_you_want' ),
	);
	wp_localize_script("pay_what_you_want_script","WPAjax", $data);
}
add_action('wp_enqueue_scripts', 'bw_pay_what_you_want_style_and_scripts');


/***********************************
	Required Files
***********************************/

add_action( 'plugins_loaded', function(){

	if ( class_exists( 'WooCommerce' ) ) {
		require_once( plugin_dir_path( __FILE__ ) . 'inc/pay_what_you_want.php' );
	}
});