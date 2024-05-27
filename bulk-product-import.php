<?php

/**
 * Plugin Name: WooCommerce Bulk Product Import
 * Plugin URI:  #
 * Author:      Shah jalal
 * Author URI:  https://github.com/shahjalal132
 * Description: WooCommerce Bulk Product Import from external api source. Auto import products from external api source.
 * Version:     0.1.0
 * Domain Path: /languages
 * text-domain: bulk-product-import
 */

defined( "ABSPATH" ) || exit( "Direct Access Not Allowed" );

// Define plugin path
if ( !defined( 'AUTOLOADER_PLUGIN_PATH' ) ) {
    define( 'AUTOLOADER_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
}

// Define plugin url
if ( !defined( 'AUTOLOADER_PLUGIN_URL' ) ) {
    define( 'AUTOLOADER_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if ( !defined( 'AUTOLOADER_ASSETS_PATH' ) ) {
    define( 'AUTOLOADER_ASSETS_PATH', AUTOLOADER_PLUGIN_URL . '/assets' );
}

// require autoloader files
require_once AUTOLOADER_PLUGIN_PATH . '/inc/helpers/autoloader.php';
require_once AUTOLOADER_PLUGIN_PATH . '/load.php';

/**
 * Load plugin text domain for internationalization.
 */
function autoloader_plugin_load_textdomain() {
    load_plugin_textdomain( 'autoloader-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'autoloader_plugin_load_textdomain' );

function autoloader_get_theme_instance() {
    \AUTOLOADER\Inc\Autoloader::get_instance();
}

autoloader_get_theme_instance();