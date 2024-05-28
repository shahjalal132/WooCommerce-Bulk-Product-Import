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
if ( !defined( 'BULK_PRODUCT_IMPORT_PLUGIN_PATH' ) ) {
    define( 'BULK_PRODUCT_IMPORT_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
}

// Define plugin url
if ( !defined( 'BULK_PRODUCT_IMPORT_PLUGIN_URL' ) ) {
    define( 'BULK_PRODUCT_IMPORT_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if ( !defined( 'BULK_PRODUCT_IMPORT_ASSETS_PATH' ) ) {
    define( 'BULK_PRODUCT_IMPORT_ASSETS_PATH', BULK_PRODUCT_IMPORT_PLUGIN_URL . '/assets' );
}

// require autoloader files
require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/helpers/autoloader.php';
require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/load.php';

/**
 * Load plugin text domain for internationalization.
 */
function bulk_product_import_plugin_load_textdomain() {
    load_plugin_textdomain( 'bulk-product-import', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'bulk_product_import_plugin_load_textdomain' );

function bulk_product_import_get_theme_instance() {
    \BULK_IMPORT\Inc\Autoloader::get_instance();
}

bulk_product_import_get_theme_instance();

// create db tables
register_activation_hook( __FILE__, 'create_db_tables' );