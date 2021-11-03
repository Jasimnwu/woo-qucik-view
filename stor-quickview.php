<?php
/*
Plugin Name: Stor Quick view
Plugin URI: http://jaism.com
Description: This stor Quick view
Version: 0.1
Author: jasim
Author URI:http://jaism.com
Text Domain: fd-quickview
Generated By: http://jaism.com
*/

// If this file is called directly, abort. //
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
 // end if hello

 function stor_quick_view_missing_wc_notice() {

	echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'Quick View requires WooCommerce to be installed and active. You can download %s here.', 'wc_quick_view' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>';
}

// Let's Initialize Everything
if ( file_exists( plugin_dir_path( __FILE__ ) . 'init.php' ) ) {
require_once( plugin_dir_path( __FILE__ ) . 'init.php' );
}

function quickview_load_textdomain() {
    load_plugin_textdomain( 'quickview', false, dirname( __FILE__ ) . '/languages' );

    if ( ! class_exists( 'WooCommerce' ) ) {
		add_action( 'admin_notices', 'stor_quick_view_missing_wc_notice' );
		return;
	}

}
add_action( 'plugins_loaded', 'quickview_load_textdomain' );