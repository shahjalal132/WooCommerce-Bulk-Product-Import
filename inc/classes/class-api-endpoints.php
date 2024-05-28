<?php

namespace BULK_IMPORT\Inc;

use BULK_IMPORT\Inc\Traits\Singleton;

class Api_Endpoints {

    use Singleton;

    public function __construct() {
        $this->setup_hooks();
    }

    public function setup_hooks() {
        add_action( 'rest_api_init', [ $this, 'register_api_endpoints' ] );
    }

    public function register_api_endpoints() {
        register_rest_route( 'bulk-import/v1', '/server-status', [
            'methods'  => 'GET',
            'callback' => [ $this, 'bulk_product_import_callback' ],
        ] );
    }

    public function bulk_product_import_callback() {
        return $this->server_status_check();
    }

    private function server_status_check() {
        // For now, returning a sample response.
        return new \WP_REST_Response( [
            'success' => true,
            'message' => 'Server is up and running.',
        ], 200 );
    }
}
