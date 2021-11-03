<?php
/* woocommerce theme support * */  


function fd_quickview_quickview_render_infooter() {
	echo '<div class="woocommerce" id="fdquick-viewmodal">
           <div class="fdqv-modal-dialog product">
               <div class="fdqv-modal-content">
                   <button type="button" class="fdqvcloseqv"><i class="fas fa-times"></i></button>
                   <div class="fdqv-modal-body">
                       
                   </div>
                </div>
            </div>
        </div>';
}
add_action( 'wp_footer', 'fd_quickview_quickview_render_infooter' );


if ( !function_exists( 'fd_quickview_quickview_button' ) ) {
	function fd_quickview_quickview_button() {
        $option = get_option( 'fd_quick_view_trigger' );
        $on = get_option( 'fd_quick_view_enable','yes');
       
        $icon = '<i class="fas fa-eye"></i>';
        if ( 'icon' == $option ) {
           $icontext =  $icon;
        }
        elseif ( 'text' == $option ) {
           $icontext = __( 'Quick View', 'fd-quickview');
        }
        else {
           $icontext = $icon . __( 'Quick View', 'fd-quickview');
        } 
        if ('yes' === $on) {
    
		$ajaxurl = admin_url('admin-ajax.php');
	    $nonce = wp_create_nonce('stor_product_load'); 
	    echo '<a href="javascript:void(0);" class="storquickview" data-id="'.get_the_ID().'" data-url="'. $ajaxurl .'" data-referrar="'.$nonce .'">'. $icontext.'</a>';
        }
    
	}
}

add_action('woocommerce_after_shop_loop_item', 'fd_quickview_quickview_button',5);


//content loaded 

function fd_quickview_quickview() {
    if ( isset( $_POST['id'] ) && (int) $_POST['id'] ) {
        global $post, $product, $woocommerce;
        $id      = ( int ) $_POST['id'];
        $post    = get_post( $id );
        $product = get_product( $id );
        if ( $product ) { 
			include __DIR__.'/../inc/quickview-content.php';
        }
    }
    wp_die();
}

add_action( 'wp_ajax_fd_quickview', 'fd_quickview_quickview' );
add_action( 'wp_ajax_nopriv_fd_quickview', 'fd_quickview_quickview');



?>