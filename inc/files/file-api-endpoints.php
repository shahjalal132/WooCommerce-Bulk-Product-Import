<?php

/**
 * API Endpoints file
 */

// create an api endpoint for products
add_action( 'rest_api_init', 'bulk_products_import' );

function bulk_products_import() {

    // add new api endpoint to get products from api and add them to database
    register_rest_route( 'bulk-import/v1', '/sync-products', [
        'methods'  => 'GET',
        'callback' => 'sync_products_api_callback',
    ] );

}

function sync_products_api_callback() {
    return products_import_woocommerce();
}