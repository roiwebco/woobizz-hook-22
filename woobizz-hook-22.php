<?php
/*
Plugin Name: Woobizz Hook 22 
Plugin URI: http://woobizz.com
Description: Disable image link and lightbox on product page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook22
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook22_load_textdomain' );
function woobizzhook22_load_textdomain() {
  load_plugin_textdomain('woobizzhook22', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
    add_action( 'after_setup_theme', 'woobizzhook22_remove_lightbox_on_product_image', 100 );
	add_action('wp_head','woobizzhook22_remove_image_lightbox_link',100);
	
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook22_admin_notice' );
}
//Hook 22
function woobizzhook22_remove_lightbox_on_product_image() {
	remove_theme_support( 'wc-product-gallery-lightbox');	
}

function woobizzhook22_remove_image_lightbox_link(){
 echo"<style>figure.woocommerce-product-gallery__wrapper{pointer-events: none!important;cursor: default!important;}</style>";
}

//Hook21 Notice
function woobizzhook22_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 22 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook22' ); ?></p>
    </div>
    <?php
}