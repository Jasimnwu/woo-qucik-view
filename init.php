<?php 
/*
*
*	***** myplugin *****
*
*	This file initializes all M Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'ABSPATH' ) ) {
	die;
} // end if
// Define Our Constants
define('QUICKVIEW_CORE_INC',dirname( __FILE__ ).'/inc/');
define('QUICKVIE_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('QUICKVIE_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('QUICKVIE_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/
function quickview_register_core_css(){
wp_enqueue_style('fontawesome-min', QUICKVIE_CORE_CSS . 'all.min.css',null,time(),'all');
wp_enqueue_style('bootstrap-min', QUICKVIE_CORE_CSS . 'bootstrap.min.css',null,time(),'all');
wp_enqueue_style('slick-css', QUICKVIE_CORE_CSS . 'slick.css',null,time(),'all');
wp_enqueue_style('slick-theme', QUICKVIE_CORE_CSS . 'slick-theme.css',null,time(),'all');
wp_enqueue_style('quickview-core', QUICKVIE_CORE_CSS . 'quick-view-core.css',null,time(),'all');
};
add_action( 'wp_enqueue_scripts', 'quickview_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function quickview_register_core_js(){
// Register Core Plugin JS	
wp_enqueue_script('fontawesome-min', QUICKVIE_CORE_JS . 'all.min.js','jquery',time(),true);
wp_enqueue_script('bootstrap-min', QUICKVIE_CORE_JS . 'bootstrap.min.js','jquery',time(),true);
wp_enqueue_script('slick-min', QUICKVIE_CORE_JS . 'slick.min.js','jquery',time(),true);
wp_enqueue_script('quickview-core', QUICKVIE_CORE_JS . 'quickview-core.js','jquery',time(),true);
};
add_action( 'wp_enqueue_scripts', 'quickview_register_core_js' );    
/*
*
*  Includes
*
*/ 
// Load the Functions
if ( file_exists( QUICKVIEW_CORE_INC . 'quickview-core-functions.php' ) ) {
	require_once QUICKVIEW_CORE_INC . 'quickview-core-functions.php';
}     
// Load the ajax Request
if ( file_exists( QUICKVIEW_CORE_INC . 'quickview-ajax-request.php' ) ) {
	require_once QUICKVIEW_CORE_INC . 'quickview-ajax-request.php';
} 
// Load the Shortcodes
if ( file_exists( QUICKVIEW_CORE_INC . 'quickview-shortcodes.php' ) ) {
	require_once QUICKVIEW_CORE_INC . 'quickview-shortcodes.php';
}

// setting


function settings( $settings ) {

	$settings[] = array(
		'name' => __( 'Quick View', 'fd-quickview' ),
		'type' => 'title',
		'desc' => 'The following options are used to configure the Quick View extension.',
		'id'   => 'fd_quick_view',
	);

	$settings[] = array(
		'id'      => 'fd_quick_view_enable',
		'name'    => __( 'Enable Quick View', 'fd-quickview' ),
		'desc'    => __( 'Choose what event should trigger quick view', 'fd-quickview' ),
		'type'    => 'checkbox',
		'default' => 'yes',
		
	);
	$settings[] = array(
		'id'      => 'fd_quick_view_trigger',
		'name'    => __( 'Quick View Style', 'fd-quickview' ),
		'desc'    => __( 'Choose what event should trigger quick view', 'fd-quickview' ),
		'type'    => 'select',
		'options' => array(
			'icon'   => __( 'Icon', 'fd-quickview' ),
			'text' => __( 'Text', 'fd-quickview' ),
			'icon_text' => __( 'Icon with Text', 'fd-quickview' ),
			
		),
	);
	$settings[] = array(
		'type' => 'sectionend',
		'id'   => 'fd_quick_view',
	);

	return $settings;
}
add_filter( 'woocommerce_general_settings', 'settings' );