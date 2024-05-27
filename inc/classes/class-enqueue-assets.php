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
    }

    public function enqueue_css() {
        // Register CSS
        wp_register_style( "style", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/css/be-style.css", [], false, "all" );

        // enqueue CSS
        wp_enqueue_style( "style" );
    }

    public function enqueue_js() {

        // Register JS
        wp_register_script( "app", BULK_PRODUCT_IMPORT_ASSETS_PATH . "/js/app.js", [ 'jquery' ], false, true );

        // enqueue JS
        wp_enqueue_script( "app" );
    }
}