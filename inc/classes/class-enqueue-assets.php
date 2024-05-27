<?php

namespace BULK_IMPORT\Inc;

use BULK_IMPORT\Inc\Traits\Singleton;

class Enqueue_Assets {

    use Singleton;

    public function __construct() {
        $this->setup_hooks();
    }

    public function setup_hooks() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_css' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_js' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_style' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_script' ] );
    }

    public function enqueue_css() {
        // Register CSS
        wp_register_style( "be-style", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/css/be-style.css", [], false, "all" );
        wp_register_style( "be-bootstrap", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/css/bootstrap.min.css", [], false, "all" );

        // enqueue CSS
        wp_enqueue_style( "be-style" );
        wp_enqueue_style( "be-bootstrap" );
    }

    public function enqueue_js() {

        // Register JS
        wp_register_script( "be-app", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/js/app.js", [ 'jquery' ], false, true );
        wp_register_script( "be-bootstrap", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/js/bootstrap.bundle.min.js", [], false, true );

        // enqueue JS
        wp_enqueue_script( "be-app" );
        wp_enqueue_script( "be-bootstrap" );
    }

    public function admin_enqueue_style() {
        wp_register_style( "be-admin-bootstrap", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/css/bootstrap.min.css", [], false, "all" );

        wp_enqueue_style( "be-admin-bootstrap" );
    }

    public function admin_enqueue_script() {
        wp_register_script( "be-admin-menu", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/js/admin-menu.js", ['jquery'], false, true );
        wp_localize_script( 'be-admin-menu', 'bulkProductImport', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'bulk_product_import_nonce' ),
        ] );

        wp_enqueue_script( "jquery-ui-tabs" );
        wp_enqueue_script( "be-admin-menu" );
    }
}